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
              <v-text-field
                v-model="first_name"
                :rules="firstnameRules"
                label="FirstName"
                prepend-icon="mdi-account"
                required
              ></v-text-field>

              <v-text-field
                v-model="last_name"
                :rules="lastnameRules"
                label="LastName"
                prepend-icon="mdi-account"
                required
              ></v-text-field>

              <v-radio-group :rules="genderRules" v-model="gender" row>
                <v-radio label="Male" value="Male"></v-radio>

                <v-radio label="Female" value="Female"></v-radio>
              </v-radio-group>

              <v-select
                v-model="class_name"
                :rules="classRules"
                prepend-icon="mdi-school"
                label="Class"
                :items="student_class"
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
                label="Choose image profile"
                prepend-icon="mdi-camera"
              >
              </v-file-input>

              <v-text-field
                v-model="userId"
                type="number"   
                step="any"
                min="0"
                ref="input"
                :rules="[numberRule]"
                label="UserId"
                prepend-icon="mdi-account"
              ></v-text-field>

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

    <v-simple-table>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Profile</th>
            <th class="text-left">FirstName</th>
            <th class="text-left">LastName</th>
            <th class="text-left">Gender</th>
            <th class="text-left">Class_name</th>
            <th class="text-left">Phone Number</th>
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
      dialog: false,
      dialogMode: "create",
      valid: true,
      show1: false,
      studentAction: {},
      dialogDisplay: false,
      student_class: [],
      class: {},

      // Data from input
      first_name: null,
      last_name: null,
      gender: null,
      class_name: null,
      phonenumber: null,
      userId: null,
      profile: "",
      // Rule of input data
      firstnameRules: [(v) => !!v || "Firstname is required"],
      lastnameRules: [(v) => !!v || "Lastname is required"],
      genderRules: [(v) => !!v || "Gender is required"],
      classRules: [(v) => !!v || "Class is required"],
      phonenumberRules: [(v) => !!v || "PhoneNumber is required"],
      profileRules: [(v) => !!v || "Profile is required"],
      numberRule: [(v) => !!v || "UserId is required"],

      // data get from backend
    };
  },
  methods: {
    getStudent() {
      axios
        .get("/students")
        .then((res) => {
          this.students = res.data;
          console.log(this.students);
        })
        .catch((error) => {
          console.log(error.res.data.errors);
        });
    },
    // **********************|~SHOW CREATE FORM DIALOG~|********************** //
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;
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
        studentInfo.append("class_name", this.class_name);
        studentInfo.append("phone", this.phonenumber);
        console.log(studentInfo);
        axios
          .post("/students", studentInfo)
          .then((response) => {
            this.closeDialog();
            this.getStudent();
            console.log("Hello",response.data);
          })
          .catch((error) => {
            console.log("dsdsd",error.response.data.errors);
          });
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
    this.getStudent();

    axios.get('/class')
    .then(res => {
      this.class = res.data
      for(let clas in res.data) {
        this.student_class.push(clas);
      }
    })
  }
};
</script>
