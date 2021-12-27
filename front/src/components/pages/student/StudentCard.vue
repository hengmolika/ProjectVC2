<template>
  <tr class="text-left">
    <td>
      <v-list-item-avatar>
        <v-img
          :src="student.profile !== '' ? url + student.profile : url + 'profile.png'"
        ></v-img>
      </v-list-item-avatar>
    </td>
    <td>{{ student.first_name }}</td>
    <td>{{ student.last_name }}</td>
    <td>{{ student.gender }}</td>
    <td>{{ student.class_name }}</td>
    <td>{{ student.phone }}</td>
    <td class="text-center align-center">
      <v-btn class="mr-2" color="success">
        <v-icon >mdi-pencil</v-icon>EDIT
      </v-btn>
      <v-btn
        class="ml-2"
        color="red white--text"
      >
        <v-icon>mdi-delete</v-icon>DELETE
      </v-btn>
    </td>
    
  </tr>
</template>

<script>
export default {
   props: ["student"],

  data() {
    return {
      url: "http://localhost:8000/storage/images/",
    };
  },
  methods: {
    
  },
};
</script>
<style>
</style>
