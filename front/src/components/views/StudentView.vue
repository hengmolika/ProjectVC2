<template>
  <div>
    <v-btn
      @click.stop="showCreateForm"
      depressed
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
          <v-card-text class="mt-5">
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-row>
                <v-col cols="12" sm="6">
                  <v-text-field
                    v-model="first_name"
                    :rules="firstnameRules"
                    label="First Name"
                    prepend-icon="mdi-account"
                  ></v-text-field>
                </v-col>

                <v-col cols="12" sm="6">
                  <v-text-field
                    v-model="last_name"
                    :rules="lastnameRules"
                    label="Last Name"
                    prepend-icon="mdi-account"
                  ></v-text-field>
                </v-col>
              </v-row>

              <v-radio-group :rules="genderRules" v-model="gender" row>
                <v-radio label="Male" value="Male"></v-radio>
                <v-radio label="Female" value="Female"></v-radio>
              </v-radio-group>

              <v-select
                v-model="class_name"
                prepend-icon="mdi-school"
                label="Class"
                :rules="classRules"
                :items="items"
                item-text="class_group"
                item-value="class_group"
                required
              >
              </v-select>

              <v-text-field
                v-model="phonenumber"
                :rules="phonenumberRules"
                prepend-icon="mdi-phone"
                label="Phone Number"
                required
              ></v-text-field>

              <v-file-input
                v-model="profile"
                :rules="profileRules"
                label="Choose profile image "
                prepend-icon="mdi-camera"
              >
              </v-file-input>
            </v-form>
          </v-card-text>
        </div>

        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|-REMOVE DIALOG-|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div v-else>
          <v-card-text class="mt-5">
            <v-alert outlined type="error" prominent border="left">
              Are you sure to delete this user?
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

    <div class="container mt-12">
      <v-alert dense text type="success" v-if="this.messageAlert !== ''" dismissible elevation="2">
        {{ messageAlert }}
      </v-alert>

      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th>Profile</th>
              <th>FirstName</th>
              <th>LastName</th>
              <th>Gender</th>
              <th>Class_name</th>
              <th>Phone Number</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <student-card
              v-for="student in students"
              :key="student.id"
              :student="student"
            >
            </student-card>
          </tbody>
        </template>
      </v-simple-table>

    </div>
  </div>
</template>
<script>
import axios from "../../api/api.js";
import StudentCard from "../pages/students/StudentCard.vue";
export default {
  components: {
    "student-card": StudentCard,
  },
  data() {
    return {
      students: [],
      url: "http://localhost:8000/storage/images/",
      dialog: false,
      dialogMode: "create",
      valid: true,
      show1: false,
      studentAction: {},
      dialogDisplay: false,
      student_class: [],
      messageAlert: "",
      class: [],
      items: [
        { class_group: "SNA 2021" },
        { class_group: "WEB 2021 A" },
        { class_group: "WEB 2021 B" },
        { class_group: "SNA 2022" },
        { class_group: "WEB 2022 A" },
        { class_group: "WEB 2022 B" },
        { class_group: "SNA 2023" },
        { class_group: "WEB 2023 A" },
        { class_group: "WEB 2023 B" },
        { class_group: "SNA 2024" },
        { class_group: "WEB 2024 A" },
        { class_group: "WEB 2024 B" },
        { class_group: "SNA 2025" },
        { class_group: "WEB 2025 A" },
        { class_group: "WEB 2025 B" },
        { class_group: "SNA 2026" },
        { class_group: "WEB 2026 A" },
        { class_group: "WEB 2026 B" },
      ],

      // Data from input
      first_name: null,
      last_name: null,
      gender: null,
      class_name: null,
      phonenumber: null,
      profile: "",

      // Rule of input data
      firstnameRules: [(v) => !!v || "Firstname is required"],
      lastnameRules: [(v) => !!v || "Lastname is required"],
      genderRules: [(v) => !!v || "Gender is required"],
      classRules: [(v) => !!v || "Class is required"],
      phonenumberRules: [(v) => !!v || "PhoneNumber is required"],
      profileRules: [(v) => !!v || "Profile is required"],

      // data get from backend
    };
  },
  methods: {
    getStudent() {
      axios
        .get("/students")
        .then((res) => {
          this.students = res.data;
          // console.log(this.students);
        })
        .catch((error) => {
          console.log(error.res.data.errors);
        });
    },
    // **********************|~SHOW CREATE FORM DIALOG~|********************** //
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;
      this.messageAlert = "";
    },

    // **********************|~CLOSE FORM DIALOG~|********************** //
    closeDialog() {
      this.dialog = false;
      if (this.dialogMode !== "delete") {
        this.$refs.form.reset();
      }
    },

    // **********************|~CONFIRM DIALOG~|********************** //
    onConfirm() {
      if (this.dialogMode === "create") {
        this.creatStudent();
      }
    },

    // **********************|~CREATE NEW STUDENT~|********************** //
    creatStudent() {
      if (this.$refs.form.validate()) {
        let studentInfo = new FormData();
        studentInfo.append("first_name", this.first_name);
        studentInfo.append("last_name", this.last_name);
        studentInfo.append("gender", this.gender);
        studentInfo.append("class", this.class_name);
        studentInfo.append("profile", this.profile);
        studentInfo.append("phone", this.phonenumber);
        console.log(studentInfo);
        axios
          .post("/students", studentInfo)
          .then(() => {
            this.closeDialog();
            this.getStudent();
            this.messageAlert = "Created success";
          })
          .catch((error) => {
            console.log("message", error.response.data.errors);
          });
        console.log(this.class_name);
        console.log(this.phonenumber);
        console.log(this.last_name);
        console.log(this.first_name);
        console.log(this.gender);
        console.log(this.profile);
      }
    },
  },
  computed: {
    dialogTitle() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE NEW STUDENT";
      }
      return message;
    },
    dialogButton() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE";
      }
      return message;
    },
    dialogColor() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "primary";
      }
      return message;
    },
  },
  mounted() {
    axios.get("/class").then((res) => {
      this.student_class = JSON.stringify(res.data.class);
      console.log(this.student_class);
    });

    this.getStudent();
  },
};
</script>
