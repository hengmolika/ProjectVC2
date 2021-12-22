<template>
  <tr class="text-left">
    <td>
      <v-list-item-avatar>
        <v-img :src=" user.profile !== '' ? url + user.profile : url + 'profile.jpg' "></v-img>
      </v-list-item-avatar>
    </td>
    <td>{{ user.username }}</td>
    <td>{{ user.email }}</td>
    <td>{{ user.roles }}</td>
    <td :class="user.roles !== 'ADMIN' ? 'text-center align-center' : 'text-center' ">
      <v-btn class="mr-2" color="success" @click="toEditUser(user)">
        <v-icon >mdi-pencil</v-icon>
      </v-btn>
      <v-btn class="ml-2" color="red" v-if="user.roles !== 'ADMIN'">
        <v-icon>mdi-delete-sweep</v-icon>
      </v-btn>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["user"],
  emits: ["requestToDeleteUser", "requestToEdit"],
  data() {
    return {
      url: "http://localhost:8000/storage/images/",
    };
  },
  methods: {
    toRemoveUser(id) {
      this.$emit("requestToDeleteUser", id);
    },
    toEditUser(user){
      this.$emit("requestToEdit", user)
    }
  },
};
</script>
<style></style>
