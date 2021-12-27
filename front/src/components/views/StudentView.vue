<template>
  <div class="text-center">
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
          <v-card-text class="mt-5">
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                v-model="first_name"
                :rules="FirstnameRules"
                label="FirstName"
                prepend-icon="mdi-account"
                required
              ></v-text-field>

              <v-text-field
                v-model="last_name"
                :rules="LastnameRules"
                label="Lastname"
                prepend-icon="mdi-account"
                required
              ></v-text-field>

              <v-radio-group :rules="GenderRules" v-model="gender" row>
                <v-radio label="Male" value="Male"></v-radio>
                <v-radio label="FeMale" value="Female"></v-radio>
              </v-radio-group>

              <v-text-field
                v-model="phone"
                :rules="LastnameRules"
                label="Phone Number"
                prepend-icon="mdi-phone"
                required
              ></v-text-field>

              <v-select
                v-model="class_name"
                :items="studentClass"
                :rules="ClassnameRules"
                prepend-icon="mdi-school"
                label="Class"
                required
              ></v-select>

              <v-file-input
                :rules="profileRules"
                v-model="profile"
                label="Choose image profile"
                filled
                prepend-icon="mdi-camera"
              ></v-file-input>
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

    <!-- TABLE -->

    <div class="container mt-12">
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th>Profile</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Gender</th>
              <th>Class_name</th>
              <th>Phone Number</th>
            </tr>
          </thead>
          <tbody>
            <student-card
              v-for="student of students"
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
// IMPORT AXIOS ----------------------------------------
import axios from "../../api/api.js";
// import StudentCard from "../pages/student/StudentCard.vue";
import StudentCard from "../pages/student/StudentCard";
// IMPORT USER FORM SEARCH ----------------------------------------

// IMPORT USER CARD ----------------------------------------

export default {
  components: {
    "student-card": StudentCard,
  },
  data() {
    return {
      valid: true,
      url: "http://localhost:8000/storage/images/",
      dialog: false,
      show1: false,
      dialogMode: "create",
      students: [],
      // DATA FROM INPUT ----------------------------------------
      first_name: null,
      last_name: null,
      gender: null,
      class_name: null,
      phone: null,
      profile: "",
      studentClass: [],
      // RULE OF INPUT DATA ----------------------------------------
      FirstnameRules: [(v) => !!v || "Firstname is required"],
      LastnameRules: [(v) => !!v || " Lastname is required"],
      GenderRules: [(v) => !!v || "Gender is required"],
      ClassnameRules: [(v) => !!v || "ClassName is required"],
      phonenumberRules: [(v) => !!v || "phonenumber is required"],
      profileRules: [(v) => !!v || "Profile is required"],
      // DATA GET FROM BACKEND ----------------------------------------

      dialogDisplay: false,
    };
  },
  computed: {
    // **********************|~TITLE DIALOG~|********************** //
    dialogTitle() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE NEW USER";
      }
      return message;
    },
    // **********************|~BUTTON DIALOG~|********************** //
    dialogButton() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE";
      }
      return message;
    },
    // **********************|~COLOR DIALOG~|********************** //
    dialogColor() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "primary";
      }
      return message;
    },
  },
  methods: {
     // **********************|~GET USERS~|********************** //
    getStudent() {
      axios.get("/students").then((res) => {
        this.students = res.data;
      }).catch(error =>{
        console.log(error.response.data);
      })
    },

    // **********************|~GET STUDENT CLASS ~|**********************//
    getStudentClass(){
      axios.get("/class")
      .then((res)=>{
        this.studentClass = res.data.class;
        console.log("student class",this.studentClass);
      })
    },
    // **********************|~SHOW CREATE FORM DIALOG~|********************** //
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;

      this.first_name = null;
      this.last_name = null;
      this.gender = null;
      this.class_name = null;
      this.phone = null;
      this.profile = "";
    },
    // **********************|~SHOW REMOVE DIALOG~|********************** //

    // **********************|~CLOSE FORM DIALOG~|********************** //
    closeDialog() {
      this.dialog = false;
      if (this.dialogMode !== "delete") {
        this.$refs.form.reset();
      }
    },

    // **********************|~CREATE NEW USER~|********************** //
    createUser() {
      if (this.$refs.form.validate()) {
        let studentInfo = new FormData();
        let userId = localStorage.getItem("userId");
        studentInfo.append("user_id", userId);
        studentInfo.append("first_name", this.first_name);
        studentInfo.append("last_name", this.last_name);
        studentInfo.append("gender", this.gender);
        studentInfo.append("class_name", this.class_name);
        studentInfo.append("phone", this.phone);
        studentInfo.append("profile", this.profile);

        axios
          .post("/students", studentInfo)
          .then((response) => {
            this.students.push(response.data.user);
            localStorage.setItem("token", response.data.token);
            this.closeDialog();
            this.getStudent();
          })
          .catch((error) => {
            console.log(error.response.data.errors);
          });
      }
    },

    // **********************|~REMOVE USER~|********************** //

    // **********************|~CONFIRM DIALOG~|********************** //
    onConfirm() {
      if (this.dialogMode === "create") {
        this.createUser();
      }
    },

  },

  mounted() {
    this.getStudent();
    console.log("student lisht", this.students);
    this.getStudentClass();
    
    
  },
};
</script>
