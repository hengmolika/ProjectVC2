<template>
  <v-app class="grey darken-4" >
    <v-container>
      <!--*~*~*~*~*~*~*~*~*~*~*~*~[SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
      <v-row align="center">
        <!--*~*~*~*~*~*~*~*~*~*~*~*~[SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
        <v-col class="d-flex" cols="12" sm="4">
          <v-text-field
            :items="items"
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
          <v-select :items="items" label="Sort by*" solo></v-select>
        </v-col>
        <div class="ml-auto">
            <v-btn class="mx-2" fab dark color="blue lighten-1" id="add">
                <v-icon dark> mdi-plus </v-icon>
            </v-btn>
        </div>
       
      </v-row>
      <div class="text">
        <h2 class="white--text">List Of Users</h2>
      </div>
      <hr color="orange" />
      <v-layout row wrap mt-10>
        <user-card v-for="user of users" :key="user.id" :user="user">
        </user-card>
      </v-layout>
    </v-container>
  </v-app>

</template>

<script>
import axios from "../../axios-http.js";
import userCard from "../pages/users/userCard.vue";

export default {
  components: {
    "user-card": userCard,
  },
  data() {
    return {
      users: [],
    };
  },

  methods: {
    getUser() {
      axios.get("/users").then((response) => {
        this.users = response.data;
        console.log(this.users);
      });
    },
  },

  mounted() {
    this.getUser();
  },
};
</script>

<style scoped>
    #add{
        margin-right:auto;
    }
</style>
