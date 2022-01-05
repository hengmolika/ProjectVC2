<template>
  <v-app>
    <nav-app
      v-if="!$route.path.includes('login')"
      :userdata="user"
      @requestToLogout="Logout"
    >
    </nav-app>

    <v-main>
      <router-view @requestLogin="Login" :message="messageError" :userdata="user"> </router-view>
    </v-main>
    <!-- <footer-app v-if="!$route.path.includes('login')"></footer-app> -->
  </v-app>
</template>

<script>
import axios from "./api/api.js";
import NavBar from "./components/nav/Navbar.vue";
// import Footer from "./components/nav/Footer.vue";

export default {
  name: "App",

  components: {
    "nav-app": NavBar,
    // "footer-app": Footer,
  },
  data() {
    return {
      user: null,
      messageError: "",
    };
  },
  methods: {
    Login(userData) {
      axios
        .post("/login", userData)
        .then((response) => {
          this.user = response.data.user;
          localStorage.setItem("token", response.data.token);
          localStorage.setItem("userId", response.data.user.id);
          localStorage.setItem("role", response.data.user.roles);
         
          this.$router.push("/")
    
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.messageError = error.response.data.message;
          }
        });
    },
    Logout() {
      axios.post("/logout").then((response) => {
        this.user = null;
        this.messageError = "";
        localStorage.removeItem("userId");
        localStorage.removeItem("token");
        this.$router.push("/login");
        console.log(response.data);
      });
    },
  },
  mounted() {
    
    if (localStorage.userId && localStorage.token) {
      axios.get("/users/" + localStorage.userId).then((response) => {
        this.user = response.data;
      });
    }

    if(this.user === []) {
      localStorage.clear()
    }
  },
};
</script>
