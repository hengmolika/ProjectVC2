<template>
  <div class="text-center">
    <v-btn
      depressed
      @click.stop="showCreateForm"
      bottom
      color="primary"
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
      <v-card>
        <v-toolbar color="primary" class="lighten-1" dark>
          {{ dialogTitle }}
        </v-toolbar>

        <v-card-text class="mt-5">
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
              v-model="username"
              :rules="usernameRules"
              label="Username"
              prepend-icon="mdi-account"
              required
            ></v-text-field>

            <v-text-field
              v-model="email"
              :rules="emailRules"
              label="E-mail"
              prepend-icon="mdi-email"
              required
            ></v-text-field>

            <v-text-field
              v-if="dialogMode !== 'edit' "
              v-model="password"
              :rules="passwordRules"
              label="Password"
              prepend-icon="mdi-lock"
              :append-icon="show1 ? 'eye' : 'eye-off'"
              :type="show1 ? 'text' : 'password'"
              @click:append="show1 = !show1"
              required
            ></v-text-field>

            <v-select
              v-model="role"
              :items="items"
              :rules="roleRules"
              prepend-icon="mdi-key"
              label="Select"
              data-vv-name="select"
              required
            ></v-select>

            <v-file-input
              v-if="(role !== null && role !== 'STUDENT') && dialogMode !== 'edit' "
              :rules="profileRules"
              v-model="profile"
              label="Choose image profile"
              filled
              prepend-icon="mdi-camera"
            ></v-file-input>

            <v-combobox
              v-if="role === 'STUDENT'"
              :rules="studentRules"
              prepend-icon="mdi-account-multiple"
              label="Choose"
              v-model="student"
              :items="students"
            >
            </v-combobox>
          </v-form>
        </v-card-text>

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
      <user-search
        @searchByusername="searchUsername"
        @SelectRole="selectByRole"
      >
      </user-search>
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th>PROFILE</th>
              <th>USERNAME</th>
              <th>EMAIL</th>
              <th>ROLE</th>
              <th class="text-center">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <user-card v-for="user of users" 
            :key="user.id" :user="user"
            @requestToEdit="showEditForm"
            >
            </user-card>
          </tbody>
        </template>
      </v-simple-table>
    </div>
  </div>
</template>

<script>
import axios from "../../api/api.js";
import UserFormSearch from "../pages/users/userFormSearch.vue";
import UserCard from "../pages/users/userCard.vue";
export default {
  components: {
    "user-search": UserFormSearch,
    "user-card": UserCard,
  },
  data() {
    return {
      userId: null,
      valid: true,
      url: "http://localhost:8000/storage/images/",
      dialog: false,
      show1: false,
      dialogMode: "create",
      items: ["SOCIAL AFFAIL OFFICER", "STUDENT"],
      students: [],
      // DATA FROM INPUT
      username: null,
      email: null,
      password: null,
      student: null,
      role: null,
      profile: null,
      // RULE OF INPUT DATA
      usernameRules: [(v) => !!v || "Username is required"],
      emailRules: [(v) => !!v || "Email is required"],
      passwordRules: [(v) => !!v || "Password is required"],
      studentRules: [(v) => !!v || "Student is required"],
      roleRules: [(v) => !!v || "Role is required"],
      profileRules: [(v) => !!v || "Profile is required"],
      // DATA GET FROM BACKEND
      users: [],
      userAction: {},
      dialogDisplay: false,
      isSearch: false,
    };
  },
  computed: {
    dialogTitle() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE NEW USER";
      } else if (this.dialogMode === "edit") {
        message = "EDIT THE USER";
      } else if (this.dialogMode === "delete") {
        message = "DELETE THE USER";
      }
      return message;
    },
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
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;
      this.$refs.form.reset();
    },
    closeDialog() {
      this.dialog = false;
      this.$refs.form.reset();
    },
    showEditForm(userData) {
      this.dialogMode = "edit";
      this.dialog = true;
      this.userAction = {
        id: userData.id,
        username: userData.username,
        email: userData.email,
        role: userData.roles,
      }
      this.username = this.userAction.username;
      this.email = this.userAction.email;
      if(userData.roles === 'ADMIN') {
        this.role = 'ADMIN'
      } else {
        this.role = this.userAction.role;
      }
      
      console.log(userData)
    },
    updateUser() {
      if(this.userAction.role === 'ADMIN') {
        this.role = 'ADMIN';
      }
      let myNewUserData = {
        username: this.username,
        email: this.email,
        roles: this.role
      }
      
      axios.put("/users/" + this.userAction.id, myNewUserData)
      .then(res => {
        console.log(res)
        this.getUsers();
        this.closeDialog();
      })
      .catch((error) => {
        console.log(error.res.data.errors)
      })

      
    },
    createUser() {
      if (this.$refs.form.validate()) {
        let userInfo = new FormData();
        userInfo.append("username", this.username);
        userInfo.append("email", this.email);
        userInfo.append("password", this.password);
        userInfo.append("password_confirmation", this.password);
        userInfo.append("roles", this.role);
        userInfo.append("profile", this.profile);

        axios
          .post("/register", userInfo)
          .then((response) => {
            this.users.push(response.data.user);
            console.log(response.data.user);
            this.closeDialog();
          })
          .catch((error) => {
            console.log(error.response.data.errors);
          });
      }
    },
    onConfirm() {
      if (this.dialogMode === "create") {
        this.createUser();
      }else if(this.dialogMode === "edit") {
        this.updateUser();
      }
    },
    getUsers() {
      axios.get("/users").then((res) => {
        this.users = res.data;
      });
    },

    
    // Search By Username-----------------------------------------------------------------------------
    searchUsername(username) {
      if (username !== "") {
        console.log(username);
        this.users = this.users.filter((users) =>
          users.username.toLowerCase().includes(username.toLowerCase())
        );
      } else {
        this.getUsers();
      }
      this.isSearch = true;
    },
    //Search By select roles---------------------------------------------------------------------------
    selectByRole(roleName) {
      if (roleName === "ALL") {
        this.getUsers();
      } else {
        this.users = this.users.filter((user) => user.roles === roleName);
      }
    },
  },

  mounted() {
    this.getUsers();
    this.userId = localStorage.getItem("userId");
  },
};
</script>
