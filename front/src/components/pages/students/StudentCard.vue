<template>
  <tr
    :class="student.gender === 'Male' ? 'maleStudent' : 'femaleStudent'"
    @mouseover="mouseOver"
    @mouseout="mouseout"
  >
    <td>
      <v-list-item-avatar>
        <v-img :src="url + student.profile"> </v-img>
      </v-list-item-avatar>
    </td>
    <td>{{ student.first_name }}</td>
    <td>{{ student.last_name }}</td>
    <td>{{ student.gender }}</td>
    <td>{{ student.class }}</td>
    <td v-show="!active">{{ student.phone }}</td>
    <td class="text-center" v-if="role !== 'STUDENT'" v-show="active">
      <v-btn
        icon
        color="success"
        @click.stop="editStudent(student)"
        
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn
        icon
        color="red white--text"
        @click.stop="deleteStudent(student.id)"
       
      >
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["student"],
  emits: ["studentEdit", "studentDelete"],
  data() {
    return {
      url: "http://localhost:8000/storage/images/",
      role: "",
      active: false,
    };
  },
  methods: {
    mouseOver() {
      this.active = true;
    },
    mouseout() {
      this.active = false;
    },
    editStudent(studentData) {
      this.$emit("studentEdit", studentData);
    },
    deleteStudent(id) {
      this.$emit("studentDelete", id);
    },
  },
  mounted() {
    this.role = localStorage.getItem("role");
  },
};
</script>

<style scoped>
.maleStudent {
  background: #007bdf5d;
}
.femaleStudent {
  background: #00d1b55b;
}
</style>