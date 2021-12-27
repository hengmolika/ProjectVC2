<template>
  <section>
    <v-container class="mt-5">
      <permission-search></permission-search>
      <permission-card
        v-for="permission of permissions_data"
        :key="permission.id"
        :permission="permission"
      ></permission-card>
    </v-container>
  </section>
</template>
<script>
import axios from "../../api/api.js";
import PermissionSearch from "../pages/permissions/permissionSearch.vue";
import PermissionCard from "../pages/permissions/permissionCard.vue";
export default {
  components: {
    "permission-card": PermissionCard,
    "permission-search": PermissionSearch,
  },
  data() {
    return {
      permissions_data: [],
    };
  },
  methods: {
    getPermissions() {
      axios.get("/permissions").then((response) => {
        this.permissions_data = response.data;
        console.log(this.permissions_data);
      });
    },
  },
  mounted() {
    this.getPermissions();
  },
};
</script>

<style scoped>
</style>