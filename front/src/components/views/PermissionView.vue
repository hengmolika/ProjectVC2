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
                  <select
                    v-model="student_id"
                    class="mb-3"
                    :rules="studentnameRules"
                  >
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
                          label="Picker without buttons"
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
                          label="Picker without buttons"
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
      <permission-search @searchByStudentName="searchStudentPermission">
      </permission-search>
      <permission-card
        v-for="permission of permissions_data"
        :key="permission.id"
        :permission="permission"
      ></permission-card>
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

      studentNameRules: [(v) => !!v || "student name is required"],
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

      this.student_id = 0;
      this.startDate = null;
      this.endDate = null;
      this.leave_type = null;
      this.description = null;
    },
    onConfirm() {
      if (this.dialogMode === "create") {
        this.addPermission();
        this.closeDialog();
      }
    },

    addPermission() {
      let permission_info = {
        student_id: this.student_id,
        start_date: this.startDate,
        end_date: this.endDate,
        reason: this.leave_type,
        description: this.description,
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

    getPermissions() {
      axios.get("/permissions").then((response) => {
        this.permissions_data = response.data;
        // console.log(this.permissions_data);
      });
    },
    // SEARCH STUDENT PERMISION =================================
    searchStudentPermission(first_name) {
      if (first_name !== "") {
        this.contain_students = this.contain_students.filter(
          (contain_students) =>
            contain_students.first_name
              .toLowerCase()
              .includes(first_name.toLowerCase())
        );
      } else {
        this.getPermissions();
      }
      this.isSearchStudentPermission = true;
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