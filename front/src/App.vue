<template>
  <v-app>

    <v-main>
      <router-view
        @requestLogin="Login"
        :message="messageError"
      >
      </router-view>
    </v-main>
  </v-app>
</template>

<script>
import axios from "./api/api.js";


export default {

  name: 'App',
  data() {
    return {
      user: null,
      messageError: ""
    }
  },
  methods: {
    Login(userData) {
      axios.post('/login', userData)
      .then(response => {
        this.user = response.data.user;
        localStorage.setItem("token", response.data.token);
        localStorage.setItem("userId", response.data.user.id);
        this.$router.push('/user');
        
      })
      .catch((error) => {
        if(error.response.status === 401) {
          this.messageError = error.response.data.message;
        }
        
      })
    },
    Logout() {
      axios.post('/logout')
      .then((response) => {
        this.user = null;
        this.messageError = "";
        localStorage.removeItem("userId");
        this.$router.push('/login');
        console.log(response.data);
      })
    }
  },
  created() {
    axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("token");
  },
  mounted() {
    if(localStorage.userId) {
      axios.get('/users/' + localStorage.userId)
      .then(response => {
        this.user = response.data;
      })
    }
      
  },
};
</script>
