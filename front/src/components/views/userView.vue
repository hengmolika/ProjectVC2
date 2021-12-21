<template>
  <v-app class="grey darken-3">
    <section>
      <base-dialog :modal="dialogDisplay">
        <template v-slot:buttonAction>
          <v-btn
            bottom
            color="deep-orange"
            dark
            fab
            fixed
            right
            @click="showCreateForm"
          >
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </template>

        <template v-slot:dialogTitle>
          <h5>{{ dialogTitle }}</h5>
        </template>

        <template v-slot:dialogBody>
          <div v-if="dialogMode === 'create'">
            <span class="red--text">{{ manager_error_creat_user }}</span>
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-row class="mt-3">
                <v-col cols="12" lg="6" md="6" sm="6" xs="12" class="m-0">
                  <v-text-field
                    v-model="new_data_user.username"
                    :rules="usernameRule"
                    label="Username"
                    dense
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" lg="6" md="6" sm="6" xs="12" class="m-0">
                  <v-text-field
                    label="Password"
                    v-model="new_data_user.password"
                    :rules="passwordRule"
                    dense
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" class="mt-0">
                  <v-text-field
                    v-model="new_data_user.email"
                    :rules="EmailRule"
                    label="Email"
                    dense
                    required
                  ></v-text-field>
                </v-col>
                <v-col class="d-flex" cols="12" sm="6">
                  <v-select
                    :items="roles"
                    filled
                    label="Select user role"
                    v-model="new_data_user.role"
                    :rules="roleRule"
                  ></v-select>
                </v-col>
                <v-col cols="12" lg="6" md="6" sm="6" xs="12" class="m-0">
                  <v-file-input
                    v-model="new_data_user.profile"
                    label="Choose image profile"
                    filled
                    prepend-icon="mdi-camera"
                  ></v-file-input>
                </v-col>
              </v-row>
            </v-form>
          </div>
        </template>

        <template v-slot:btnClose>
          <v-btn @click="closeDialog" dark color="grey"> Close </v-btn>
        </template>
        <template v-slot:btnSubmit>
          <v-btn @click="onConfirm" dark color="primary"> Create </v-btn>
        </template>
      </base-dialog>
    </section>

    <v-container>
      <!--*~*~*~*~*~*~*~*~*~*~*~*~[SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
      <v-row align="center">
        <!--*~*~*~*~*~*~*~*~*~*~*~*~[SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
        <v-col class="d-flex" cols="12" sm="4">
          <v-text-field
            label="Search users*"
            solo
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
          <!--*~*~*~*~*~*~*~*~*~*~*~*~[BTN SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
          <v-btn color="info" class="ms-1" height="47" width="95">
            Search
          </v-btn>
        </v-col>
        <!--*~*~*~*~*~*~*~*~*~*~*~*~[SELECT]~*~*~*~*~*~*~*~*~*~*~*~*-->
        <v-col class="d-flex" cols="12" sm="3">
          <v-select label="Sort by*" solo></v-select>
        </v-col>
      </v-row>
      <div class="text">
        <h2 class="white--text">List Of Users</h2>
      </div>
      <hr color="blue" class="pa-2" />
      <!-- <v-layout row wrap mt-10> -->
      <v-simple-table fixed-header height="500px">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left"><h2>Profile</h2></th>
              <th class="text-left"><h2>Username</h2></th>
              <th class="text-left"><h2>Role</h2></th>
              <th class="text-left"><h2>Email</h2></th>
              <th class=""><h2>Action</h2></th>
            </tr>
          </thead>
          <tbody>
            <user-card
              v-for="user of users"
              :key="user.id"
              :user="user"
            ></user-card>
          </tbody>
          <!-- </v-layout> -->
        </template>
      </v-simple-table>
    </v-container>
  </v-app>
</template>

<script>
import axios from "../../axios-http.js";
import userCard from "../pages/users/userCard.vue";
import BaseDialog from "../ui/BaseDialog.vue";

export default {
  components: {
    "user-card": userCard,
    "base-dialog": BaseDialog,
  },
  data() {
    return {
      users: [],
      userAction: {},
      dialogDisplay: false,
      dialogMode: "create",
      valid: true,
      usernameRule: [(v) => !!v || "Username is required"],
      EmailRule: [(v) => !!v || "Email is required"],
      passwordRule: [
        (v) => !!v || "Password is required at least 4 characters",
      ],
      roleRule: [(v) => !!v || "Role is required"],

      new_data_user: {
        username: "",
        email: "",
        password: "",
        role: "",
        profile: null,
      },
      manager_error_creat_user: "",
      roles: ["Student", "Socail afair", "Admin"],
    };
  },

  methods: {
    getUser() {
      axios.get("/users").then((response) => {
        this.users = response.data;
        console.log(this.users);
      });
    },

    showCreateForm() {
      this.dialogMode = "create";
      this.dialogDisplay = true;
    },

    showEditForm() {},

    closeDialog() {
      this.dialogDisplay = false;
      this.$refs.form.reset();

      this.new_data_user.username = "";
      this.new_data_user.email = "";
      this.new_data_user.role = "";
      this.new_data_user.password = "";
      this.new_data_user.profile = null;
      this.manager_error_creat_user = "";
    },
    onConfirm() {
      if (this.dialogMode === "create") {
        if (
          this.valid &&
          this.new_data_user.username !== "" &&
          this.new_data_user.email !== "" &&
          this.new_data_user.role !== "" &&
          this.new_data_user.password !== "" &&
          this.new_data_user.profile !== null
        ) {
          this.manager_error_creat_user = "";
          this.addUser();
          this.dialogDisplay = false;
          console.log("hello", this.new_data_user.username);
        } else {
          this.manager_error_creat_user =
            "All fields are require! Please complete all the fields.";
        }
      }
      if (this.dialogMode === "remove") {
        this.deleteUser(this.userAction.remove_id);
        this.dialogDisplay = false;
      }

      this.new_data_user.username = "";
      this.new_data_user.email = "";
      this.new_data_user.role = "";
      this.new_data_user.password = "";
      this.new_data_user.profile = null;
    },

    addUser() {
      this.dialogMode = "create";
      let userData = new FormData();
      userData.append("username", this.new_data_user.username);
      userData.append("email", this.new_data_user.email);
      userData.append("roles", this.new_data_user.role);
      userData.append("password", this.new_data_user.password);
      userData.append("gender", this.new_data_user.gender);
      userData.append("profile", this.new_data_user.profile);
      console.log(userData);
      // console.log(this.valid);

      axios
        .post("/register", userData)
        .then((response) => {
          console.log(response.data);
          this.getUser();
        })
        .catch((error) => {
          console.log(error.response.data.errors);
          this.manager_error_creat_user = error.response.data.errors;
        });
    },

    // showDeleteUserForm(id) {
    //   this.dialogMode = "remove";
    //   this.dialogDisplay = true;
    //   this.userAction = {
    //     remove_id: id,
    //   };
    // },

    // deleteUser(id) {
    //   console.log(id);
    // },
  },
  computed: {
    dialogTitle() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE NEW USER";
      } else if (this.dialogMode === "edit") {
        message = "EDIT USER";
      } else if (this.dialogMode === "delete") {
        message = "DELETE USER";
      }
      return message;
    },
  },

  mounted() {
    this.getUser();
  },
};
</script>

<style scoped>
#add {
  margin-right: auto;
}
</style>
