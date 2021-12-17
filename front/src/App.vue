<template>
  <v-app>
    <!-- <v-navigation-drawer v-model="showDrawer" absolute bottom temporary>
      <nav-app> </nav-app>
    </v-navigation-drawer>
    <v-app-bar app color="blue">
      <v-app-bar-nav-icon @click.stop="showDrawer = !showDrawer" color="white">

      </v-app-bar-nav-icon>

      <v-toolbar-title style="color: white;">STUDENT LIFE</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn icon color="white">
        <v-icon>mdi-logout-variant</v-icon>
      </v-btn>
    </v-app-bar> -->
    <nav-app> </nav-app>

    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import NavBar from "./components/nav/Navbar.vue"
export default {
  name: 'App',
  components: {
    "nav-app": NavBar,
  },
  // data() {
    
  // },
};
</script>
