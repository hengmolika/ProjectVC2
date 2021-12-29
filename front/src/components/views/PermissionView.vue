<template>
  <section>
    <v-container class="mt-5">
      <v-btn
        depressed
        @click.stop="showCreateForm"
        bottom
        class="mb-8"
        color="deep-orange"
        dark
        fab
        fixed
        right
      >
        <v-icon>mdi-plus</v-icon>
      </v-btn>
      <v-dialog
        v-model="dialog"
        max-width="700"
        transition="dialog-top-transition"
      >
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|-CREATE FORM DIALOG-|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <v-card>
          <v-toolbar color="primary" class="lighten-1" dark>
            {{ dialogTitle }}
          </v-toolbar>
          <div v-if="dialogMode !== 'delete'">
            <v-card-text class="mt-2">
              <v-form ref="form" v-model="valid">
                <v-col cols="12" class="d-flex">
                  <v-icon>mdi-account</v-icon>
                  <select v-model="student_id" class="mb-3" >
                    <option
                      v-for="student of contain_students"
                      :key="student.id"
                      :value="student.id"
                    >
                      {{ student.first_name }} {{ student.last_name }}
                    </option>
                  </select>
                </v-col>
                <v-row align="center">
                  <v-col cols="6">
                    <v-menu
                      v-model="isDateSelected1"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      transition="scale-transition"
                      offset-y
                      min-width="auto"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="startDate"
                          :rules="startDateRules"
                          label="Leave on *"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="startDate"
                        @input="isDateSelected1 = false"
                      ></v-date-picker>
                    </v-menu>
                  </v-col>
                  <v-col cols="6">
                    <v-menu
                      v-model="isDateSelected2"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      transition="scale-transition"
                      offset-y
                      min-width="auto"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="endDate"
                          :rules="endDateRules"
                          label="Back on *"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="endDate"
                        @input="isDateSelected2 = false"
                      ></v-date-picker>
                    </v-menu>
                  </v-col>
                </v-row>

                <v-select
                  v-model="leave_type"
                  :rules="leave_typeRules"
                  prepend-icon="mdi-fast-forward"
                  :items="contain_leaveType"
                  label="Select Reason"
                  required
                ></v-select>
                <v-text-field
                  v-model="description"
                  :rules="descriptionRules"
                  label="Description"
                  prepend-icon="mdi-comment-text"
                  required
                ></v-text-field>
              </v-form>
            </v-card-text>
          </div>

          <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|-REMOVE DIALOG-|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
          <div v-else>
            <v-card-text class="mt-5">
              <v-alert outlined type="error" prominent border="left">
                Are you sure to delete this permission?
              </v-alert>
            </v-card-text>
          </div>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="warning" @click="closeDialog"> close </v-btn>
            <v-btn :color="dialogColor" :disabled="!valid" @click="onConfirm">
              {{ dialogButton }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <permission-search
        @searchByStudentName="searchStudentPermission"
        @SelectByClass="SelectClass"
      >
      </permission-search>
      <div v-if="!isSearch">
        <permission-card
          v-for="permission of permissions_data"
          :key="permission.id"
          :permission="permission"
          @permissiontEdit="showEditForm"
           @permissionToDelete="showDialogDelete"
        ></permission-card>
      </div>
      <div v-else>
        <permission-card
          v-for="permission of contain_permission_search"
          :key="permission.id"
          :permission="permission"
          @permissiontEdit="showEditForm"
           @permissionToDelete="showDialogDelete"
        ></permission-card>
      </div>
    </v-container>
  </section>
</template>
<script>
import axios from "../../api/api.js";
import PermissionSearch from "../pages/permissions/permissionSearch.vue";
import PermissionCard from "../pages/permissions/permissionCard.vue";
// import moment from "moment";
export default {
  components: {
    "permission-card": PermissionCard,
    "permission-search": PermissionSearch,
  },
  data() {
    return {
      permissions_data: [],
      valid: true,
      dialog: false,
      show1: false,
      dialogMode: "create",
      permissionAction: {},
      dialogDisplay: false,
      messageAlert: "",

      startDate: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      endDate: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),

      isSearchStudentPermission: false,
      isDateSelected1: false,
      isDateSelected2: false,
      student_id: 0,
      leave_type: null,
      description: null,

      contain_leaveType: [],
      contain_students: [],
      contain_permission_search: [],
      isSearch: false,

      startDateRules: [(v) => !!v || "Start date is required"],
      endDateRules: [(v) => !!v || "End date is required"],
      leave_typeRules: [(v) => !!v || "Leave type is required"],
      descriptionRules: [(v) => !!v || "description is required"],
    };
  },

  computed: {
    // **********************|~TITLE DIALOG~|********************** //
    dialogTitle() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE NEW PERMISSION";
      } else if (this.dialogMode === "edit") {
        message = "EDIT THE PERMISSION";
      } else if (this.dialogMode === "delete") {
        message = "DELETE THE PEERMISSION";
      }
      return message;
    },
    // **********************|~BUTTON DIALOG~|********************** //
    dialogButton() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE";
      } else if (this.dialogMode === "edit") {
        message = "UPDATE";
      } else if (this.dialogMode === "delete") {
        message = "DELETE";
      }
      return message;
    },
    // **********************|~COLOR DIALOG~|********************** //
    dialogColor() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "primary";
      } else if (this.dialogMode === "edit") {
        message = "success";
      } else if (this.dialogMode === "delete") {
        message = "error";
      }
      return message;
    },
  },

  methods: {
    getPermissions() {
      axios.get("/permissions").then((response) => {
        this.permissions_data = response.data;
        // console.log(this.permissions_data);
      });
    },
    // **********************|~CLOSE FORM DIALOG~|********************** //
    closeDialog() {
      this.dialog = false;
      if (this.dialogMode !== "delete") {
        this.$refs.form.reset();
      }
    },

    // **********************|~SHOW CREATE FORM DIALOG~|********************** //
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;
      this.startDate = null;
      this.endDate = null;
    },
    // ---------------------------- SHOW EDIT FORM --------------------------- \\
    showEditForm(permissionData) {
      this.dialogMode = "edit";
      this.dialog = true;
      this.messageAlert = "";

      this.permissionAction = permissionData;

      console.log("hello", permissionData);

      this.startDate = permissionData.start_date;
      this.endDate = permissionData.end_date;
      this.description = permissionData.description;
      this.leave_type = permissionData.reason;
      this.student_id = permissionData.student_id;
    },
    //----------------------- SHOW DIALOG DELETE -----------------------------------
    showDialogDelete(id) {
      this.dialogMode = "delete";
      this.dialog = true;
      this.permissionAction = {
        delete_id: id,
      }
      
    },
    

    onConfirm() {
      if (this.dialogMode === "create") {
        this.addPermission();
        this.closeDialog();
      } else if (this.dialogMode === "edit") {
        this.closeDialog();
        this.updatePermission(this.permissionAction.id);
      }else if(this.dialogMode === "delete") {
        this.deletePermission(this.permissionAction.delete_id);
        this.closeDialog();
      }
    },

    addPermission() {
      let permission_info = {
        start_date: this.startDate,
        end_date: this.endDate,
        reason: this.leave_type,
        description: this.description,
        student_id: this.student_id,
      };
      console.log(permission_info);
      axios
        .post("/permissions", permission_info)
        .then((response) => {
          console.log(response.data);
          this.getPermissions();
        })
        .catch((error) => {
          console.log(error.response.data.errors);
        });
    },

    // ---------------------------------- UPDADE PERMISSION ------------------------ \\
    updatePermission(edit_id) {
      let permission_info = {
        start_date: this.startDate,
        end_date: this.endDate,
        reason: this.leave_type,
        description: this.description,
        student_id: this.student_id,
      };
      
      console.log("infomation of permission",this.leave_type, this.description, this.student_id, this.endDae, this.start_date)

      console.log("fsyrd", this.endDate);
      axios
        .put("/permissions/" + edit_id, permission_info)
        .then((response) => {
          console.log(response.data);
          this.messageAlert = "Update success";
          this.getPermissions();
        })
        .catch((error) => {
          console.log(error.response.data.errors);
        });
    },

    //------------------------------ DELETE PERMISSION------------------------
    deletePermission(id) {
      axios.delete("/permissions/" + id).then(() => {
        this.permissions_data = this.permissions_data.filter((permission) => permission.id !== id);
        this.messageAlert = "Delete success !";
        console.log('delete successful');
      });
    },

    //==========================SEARCH PERMISSION BY USERNAME AND CLASS ============================================================
    // Search By Username-----------------------------------------------------------------------------
    searchStudentPermission(username_key, class_key) {
      if (
        (username_key !== "" && class_key !== "All Class") ||
        (username_key === "" && class_key !== "All Class")
      ) {
        console.log("search", username_key, class_key);
        this.contain_permission_search = this.permissions_data.filter(
          (permission) =>
            (permission.students.first_name
              .toLowerCase()
              .includes(username_key.toLowerCase()) ||
              permission.students.last_name
                .toLowerCase()
                .includes(username_key.toLowerCase())) &&
            permission.students.class
              .toLowerCase()
              .includes(class_key.toLowerCase())
        );
      } else {
        this.contain_permission_search = this.permissions_data.filter(
          (permission) =>
            permission.students.first_name
              .toLowerCase()
              .includes(username_key.toLowerCase()) ||
            permission.students.last_name
              .toLowerCase()
              .includes(username_key.toLowerCase())
        );
      }
      this.isSearch = true;
    },
    //Search By select Class---------------------------------------------------------------------------
    SelectClass(class_key) {
      if (class_key === "All Class") {
        this.getPermissions();
        this.isSearch = false;
      } else {
        console.log(class_key);
        this.contain_permission_search = this.permissions_data.filter(
          (permission) =>
            permission.students.class
              .toLowerCase()
              .includes(class_key.toLowerCase())
        );
        this.isSearch = true;
      }
    },
  },
  mounted() {
    this.getPermissions();
    // GET REASONS TYPE FROM BACK END=======================================================
    axios.get("/reasons").then((response) => {
      this.contain_leaveType = response.data.reasons;
      // console.log(this.contain_leaveType);
    });
    // GET AL CONTAIN STUDENT NAME THAT HAVE AT SCHOOL=============================================
    axios.get("/students").then((response) => {
      this.contain_students = response.data;
      console.log("student", this.contain_students);
    });
  },
};
</script>

<style scoped>
select {
  width: 100%;
  padding: 10px;
  outline-style: none;
  border: none;
  border-bottom: 1px solid gray;
}
option {
  font-size: medium;
  color: gray;
}
</style>