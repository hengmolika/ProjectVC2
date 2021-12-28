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
                v-if="dialogMode !== 'edit'"
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
                :items="roles"
                :rules="roleRules"
                prepend-icon="mdi-key"
                label="Select"
                required
              ></v-select>

              <!-- <v-file-input
                v-if="
                  role !== null && role === 'SOCIAL AFFAIL OFFICER' && dialogMode !== 'edit'
                "
                :rules="profileRules"
                v-model="profile"
                label="Choose image profile"
                filled
                prepend-icon="mdi-camera"
              ></v-file-input> -->

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
          <tbody v-if="!isSearch">
            <user-card
              v-for="user of users"
              :key="user.id"
              :user="user"
              @requestToDeleteUser="showDeleteDialog"
              @requestToEdit="showEditForm"
            >
            </user-card>
          </tbody>
          <tbody v-else>
            <user-card
              v-for="user of contain_users_search"
              :key="user.id"
              :user="user"
              @requestToDeleteUser="showDeleteDialog"
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
// IMPORT AXIOS ----------------------------------------
import axios from "../../api/api.js";

// IMPORT USER FORM SEARCH ----------------------------------------
import UserFormSearch from "../pages/users/userFormSearch.vue";

// IMPORT USER CARD ----------------------------------------
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
      roles: ["SOCIAL AFFAIL OFFICER", "STUDENT"],
      students: [],
      images: [
        "https://i.pinimg.com/236x/92/8f/c8/928fc874edae45b141ac45bdc157a70b.jpg",
        "https://i.pinimg.com/236x/c4/d3/e2/c4d3e2dd8797e6d7d5b07dbfc338d054.jpg",
        "https://i.pinimg.com/236x/3f/87/6c/3f876cc74af0f155af84306443b3ea56.jpg",
        "https://i.pinimg.com/236x/97/7f/e7/977fe798cf2c3a037e7aa9af6ce4b9d1.jpg",
      ],
      // DATA FROM INPUT ----------------------------------------
      username: null,
      email: null,
      password: null,
      student: null,
      role: null,
      profile: "",
      // RULE OF INPUT DATA ----------------------------------------
      usernameRules: [(v) => !!v || "Username is required"],
      emailRules: [
        (v) => !!v || "Email is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      passwordRules: [(v) => !!v || "Password is required"],
      studentRules: [(v) => !!v || "Student is required"],
      roleRules: [(v) => !!v || "Role is required"],
      profileRules: [(v) => !!v || "Profile is required"],
      // DATA GET FROM BACKEND ----------------------------------------
      users: [],
      userAction: {},
      dialogDisplay: false,
      isSearch: false,
      contain_users_search: [],
      // MESSAGE ERROR DATA
      
    };
  },
  computed: {
    // **********************|~TITLE DIALOG~|********************** //
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
    // **********************|~SHOW CREATE FORM DIALOG~|********************** //
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;

      this.username = null;
      this.email = null;
      this.password = null;
      this.student = null;
      this.role = null;
      this.profile = "";
    },
    // **********************|~SHOW REMOVE DIALOG~|********************** //
    showDeleteDialog(id) {
      this.userAction = {
        id: id,
      };
      this.dialogMode = "delete";
      this.dialog = true;
    },
    // **********************|~CLOSE FORM DIALOG~|********************** //
    closeDialog() {
      this.dialog = false;
      if (this.dialogMode !== "delete") {
        this.$refs.form.reset();
      }
    },
    showEditForm(userData) {
      this.dialogMode = "edit";
      this.dialog = true;
      this.userAction = {
        id: userData.id,
        username: userData.username,
        email: userData.email,
        role: userData.roles,
      };
      this.username = this.userAction.username;
      this.email = this.userAction.email;
      if (userData.roles === "ADMIN") {
        this.role = "ADMIN";
      } else {
        this.role = this.userAction.role;
      }

    },
    updateUser() {
      if (this.userAction.role === "ADMIN") {
        this.role = "ADMIN";
      }
      let myNewUserData = {
        username: this.username,
        email: this.email,
        roles: this.role,
      };

      axios
        .put("/users/" + this.userAction.id, myNewUserData)
        .then((res) => {
          console.log(res.data);
          this.getUsers();
          this.closeDialog();
        })
        .catch((error) => {
          console.log(error.res.data.errors);
        });
    },

    // **********************|~CREATE NEW USER~|********************** //
    createUser() {
      if (this.$refs.form.validate()) {

        const imageRadom = Math.floor(Math.random() * this.images.length);
        this.profile = this.images[imageRadom];

        let userInfo = {
          username: this.username,
          email: this.email,
          password: this.password,
          password_confirmation: this.password,
          roles: this.role,
          profile: this.profile,
        };
        axios
          .post("/register", userInfo)
          .then((response) => {
            this.users.push(response.data.user);
            this.closeDialog();
          })
          .catch((error) => {
            console.log(error.response.data.errors);
          });
      }
    },

    // **********************|~REMOVE USER~|********************** //
    deleteUser() {
      let id = this.userAction.id;
      axios.delete("/users/" + id).then(() => {
        this.users = this.users.filter((user) => user.id !== id);
        this.closeDialog();
      });
    },

    // **********************|~CONFIRM DIALOG~|********************** //
    onConfirm() {
      if (this.dialogMode === "create") {
        this.createUser();
      } else if (this.dialogMode === "delete") {
        this.deleteUser();
      } else if (this.dialogMode === "edit") {
        this.updateUser();
      }
    },

    // **********************|~GET USERS~|********************** //
    getUsers() {
      axios.get("/users").then((res) => {
        this.users = res.data;
      });
    },

    //==========================SEARCH USER BY USERNAME============================================================
    // Search By Username-----------------------------------------------------------------------------
    searchUsername(username_key, role_key) {
      if (
        (username_key !== "" && role_key !== "ALL") ||
        (username_key === "" && role_key !== "ALL")
      ) {
        console.log(username_key);
        this.contain_users_search = this.users.filter(
          (user) =>
            user.username.toLowerCase().includes(username_key.toLowerCase()) &&
            user.roles.toLowerCase().includes(role_key.toLowerCase())
        );
      } else {
        this.contain_users_search = this.users.filter((user) =>
          user.username.toLowerCase().includes(username_key.toLowerCase())
        );
      }
      this.isSearch = true;
    },
    //Search By select roles---------------------------------------------------------------------------
    selectByRole(role_key) {
      if (role_key === "ALL") {
        this.getUsers();
        this.isSearch = false;
      } else {
        console.log(role_key);
        this.contain_users_search = this.users.filter((user) =>
          user.roles.toLowerCase().includes(role_key.toLowerCase())
        );
        this.isSearch = true;
      }
    },
  },
  mounted() {
    this.getUsers();
    this.userId = localStorage.getItem("userId");
  },
};
</script>
