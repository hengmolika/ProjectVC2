<template>
  <!--*~*~*~*~*~*~*~*~*~*~*~*~[CARD]~*~*~*~*~*~*~*~*~*~*~*~*-->
  <tr>
    <td class="pa-3 ">
      <v-avatar size="60" class="red lighten-2" elevation="12">
        <img :src="url + user.profile" alt="" />
      </v-avatar>
    </td>
    <td>{{ user.username }}</td>
    <td>{{ user.roles }}</td>
    <td>{{ user.email }}</td>
    <td>
      <v-card-actions class="d-inline-flex">
        <v-btn small color="info" text-color="white" >
          <!-- <v-icon small left>mdi-pencil</v-icon> -->
          <span>Edit</span>
        </v-btn>
        <v-btn small color="warning" >
          <!-- <v-icon small left>mdi-delete</v-icon> -->
          <span>remove</span>
        </v-btn>
      </v-card-actions>
    </td>
  </tr>
</template>
    

<script>
export default {
  props: ["user"],
  data() {
    return {
      url: "http://localhost:8000/storage/images/",
    };
  },
  methods: {
  },
};
</script>

<style >
</style>