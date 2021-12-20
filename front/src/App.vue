<template>
  <v-app>
    <v-main>
      <router-view/>
    </v-main>
    <user-view></user-view>
  </v-app>
</template>

<script>
import UserView from './components/views/userView.vue'
export default {
  components: {
      'user-view': UserView,
  },

  name: 'App',

  data: () => ({
    //
  }),
};
</script>
