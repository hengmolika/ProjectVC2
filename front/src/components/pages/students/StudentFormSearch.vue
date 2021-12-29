<template>
  <section>
    <v-row align="center">
      <!--*~*~*~*~*~*~*~*~*~*~*~*~[SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
      <v-col class="d-flex" cols="12" sm="4">
        <v-text-field
          v-model="keySearchStudentname"
          label="Search by studentname...*"
          solo
          prepend-inner-icon="mdi-magnify"
          
        ></v-text-field>
        <!--*~*~*~*~*~*~*~*~*~*~*~*~[BTN SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
        <v-btn color="info" class="ms-1" height="47" >
          Clear
        </v-btn>
      </v-col>
      <!--*~*~*~*~*~*~*~*~*~*~*~*~[SELECT]~*~*~*~*~*~*~*~*~*~*~*~*-->
      <v-col class="d-flex" cols="12" sm="3">
        <v-select
          label="Search by classname..."
          solo
          :items="keyClass"
          v-model="keySelectByClass"
         
        ></v-select>
      </v-col>
    </v-row>
  </section>
</template>

<script>
export default {
  // emits: ["searchByStudentname", "SelectClass"],
  data() {
    return {
      keySearchStudentname: "",
      keyClass: [
        "SNA 2021",
        "WEB 2021 A",
        "WEB 2021 B",
        "SNA 2022",
        "WEB 2022 A",
        "WEB 2022 B",
        "SNA 2023",
      ],
      keySelectByClass: "ALL",
    };
  },
  methods: {
    // searchStudentname() {
    //   this.$emit(
    //     "searchByStudentname",
    //     this.keySearchStudentname,
    //     this.keySelectByClass
    //   );
    // },
    // SelectStudentClass() {
    //   this.$emit("SelectClass", this.keySelectByClass);
    // },

    // clearText() {
    //   this.keySearchStudentname = "";
    //   this.searchStudentname();
    // },
  },
};
</script>

<style>
</style>