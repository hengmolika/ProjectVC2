<template>
 
    <v-row align="center">
      <!--*~*~*~*~*~*~*~*~*~*~*~*~[SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
      <v-col class="d-flex" cols="12" sm="4">
        <v-text-field
          :items="items"
          label="Search student*"
          solo
          prepend-inner-icon="mdi-magnify"
        ></v-text-field>
        <!--*~*~*~*~*~*~*~*~*~*~*~*~[BTN SEARCH]~*~*~*~*~*~*~*~*~*~*~*~*-->
        <v-btn color="info ms-2 p-4" height="47" width="95"> Search </v-btn>
      </v-col>
      <!--*~*~*~*~*~*~*~*~*~*~*~*~[SELECT]~*~*~*~*~*~*~*~*~*~*~*~*-->
      <v-col class="d-flex" cols="12" sm="2">
        <v-select :items="items" label="Display sort by*" solo></v-select>
      </v-col>
    </v-row>
</template>

<script>
export default {
  data() {
    return {
      items: [
        "All Class",
        "Class WEB-A 2021",
        "Class WEB-B 2021",
        "Class WEB-A 2022",
        "Class WEB-B 2022",
        "Class SNA 2021",
        "Class SNA 2022",
      ],
    };
  },
};
</script>