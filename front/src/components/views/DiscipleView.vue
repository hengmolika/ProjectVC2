<template>
  <v-container>
    <v-btn
      depressed
      @click.stop="showCreateForm"
      bottom
      color="deep-orange"
      dark
      fab
      fixed
      right
    >
      <v-icon>mdi-plus</v-icon>
    </v-btn>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|-DIALOG-|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <v-dialog
      v-model="dialog"
      max-width="700"
      transition="dialog-top-transition"
    >
      <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|-CREATE FORM DIALOG-|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
      <v-card>
        <v-toolbar color="primary" class="lighten-1" dark>
          {{ dialogTitle }}
        </v-toolbar>
        <div v-if="dialogMode !== 'delete'">
          <v-card-text class="mt-2">
            <v-form ref="form" v-model="valid">
              <!--**************|~SELECT STUDENT~|**************-->
              <v-col cols="12" class="d-flex me-4">
                <v-icon>mdi-school</v-icon>
                <select v-model="student_id">
                  <option
                    v-for="student of ListOfStudents"
                    :key="student.id"
                    :value="student.id"
                  >
                    <img :src="stu_profile + student.profile" alt="" />
                    {{ student.first_name }}
                    {{ student.last_name }}
                  </option>
                </select>
              </v-col>
              <!--**************|~SELECT DISCIPLINE TYPE~|**************-->
              <v-col cols="12">
                <v-select
                  prepend-icon="mdi-format-list-bulleted-type"
                  v-model="discipline_type"
                  :items="items"
                  chips
                  label="SELECT TYPE*"
                  multiple
                  solo
                ></v-select>
              </v-col>
              <!--**************|~SELECT DATE~|**************-->
              <v-col cols="12">
                <v-menu
                  v-model="isDateSelected"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="discipline_date"
                      :rules="discipline_date_rule"
                      label="DATE*"
                      prepend-icon="mdi-calendar-multiple-check"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                      solo
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="discipline_date"
                    @input="isDateSelected = false"
                  ></v-date-picker>
                </v-menu>
              </v-col>
              <!--**************|~DESCRIPTION~|**************-->
              <v-col cols="12">
                <v-textarea
                  prepend-icon="mdi-comment"
                  solo
                  label="DESCRIPTION*"
                  rows="1"
                ></v-textarea>
              </v-col>
            </v-form>
          </v-card-text>
        </div>

        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|-REMOVE DIALOG-|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div v-else>
          <v-card-text class="mt-5">
            <v-alert outlined type="error" prominent border="left">
              Are you sure to delete this permission?
            </v-alert>
          </v-card-text>
        </div>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="warning" @click="closeDialog"> close </v-btn>
          <v-btn :color="dialogColor" :disabled="!valid">
            {{ dialogButton }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~|FORM SEARCH|~~~~~~~~~~~~~~~~~~~~~~~~-->
    <disciplines-search></disciplines-search>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~|CARD|~~~~~~~~~~~~~~~~~~~~~~~~-->
    <disciplines-card
      v-for="discipline of DisciplineData"
      :key="discipline.id"
      :discipline="discipline"
    >
    </disciplines-card>
  </v-container>
</template>

<!--~~~~~~~~~~~~~~~~~~~~~~~~|SCRIPT|~~~~~~~~~~~~~~~~~~~~~~~~-->
<script>
import axios from "../../api/api.js";
import DisciplinesCard from "../pages/Disciplines/DisciplineCard.vue";
import DisciplinesSearch from "../pages/Disciplines/DisciplineSearch.vue";

export default {
  components: {
    "disciplines-card": DisciplinesCard,
    "disciplines-search": DisciplinesSearch,
  },
  data() {
    return {
      DisciplineData: [],
      ListOfStudents: [],
      dialogMode: "create",
      dialog: false,
      student_id: 0,
      discipline_date: new Date(
        Date.now() - new Date().getTimezoneOffset() * 60000
      )
        .toISOString()
        .substr(0, 10),

      isDateSelected: false,
    };
  },
  computed: {
    // **********************|~TITLE DIALOG~|********************** //
    dialogTitle() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE NEW DISCIPLINE";
      } else if (this.dialogMode === "edit") {
        message = "EDIT THE DISCIPLINE";
      } else if (this.dialogMode === "delete") {
        message = "DELETE THE DISCIPLINE";
      }
      return message;
    },
    // **********************|~BUTTON DIALOG~|********************** //
    dialogButton() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "CREATE";
      } else if (this.dialogMode === "edit") {
        message = "UPDATE";
      } else if (this.dialogMode === "delete") {
        message = "DELETE";
      }
      return message;
    },
    // **********************|~COLOR DIALOG~|********************** //
    dialogColor() {
      let message = "";
      if (this.dialogMode === "create") {
        message = "primary";
      } else if (this.dialogMode === "edit") {
        message = "success";
      } else if (this.dialogMode === "delete") {
        message = "error";
      }
      return message;
    },
  },
  methods: {
    // **********************|~GET DISCIPLINE~|********************** //
    getDisciplines() {
      axios.get("/disciplines").then((response) => {
        this.DisciplineData = response.data;
        console.log("dgdsgsdgf", this.DisciplineData);
      });
    },
    // **********************|~CLOSE FORM DIALOG~|********************** //
    closeDialog() {
      this.dialog = false;
      if (this.dialogMode === "create") {
        this.$refs.form.reset();
        this.student_id = 0;
      }
    },
    // **********************|~SHOW CREATE FORM DIALOG~|********************** //
    showCreateForm() {
      this.dialogMode = "create";
      this.dialog = true;
    },
  },
  mounted() {
    this.getDisciplines();

    // **********************|~GET STUDENT~|********************** //
    axios.get("/students").then((response) => {
      this.ListOfStudents = response.data;
      console.log("student lisht", this.ListOfStudents);
    });
  },
};
</script>

<!--~~~~~~~~~~~~~~~~~~~~~~~~|STYLE|~~~~~~~~~~~~~~~~~~~~~~~~-->
<style scoped>
select {
  width: 100%;
  padding: 10px;
  outline-style: none;
  border: none;
  border-bottom: 1px solid gray;
}
option {
  font-size: medium;
  color: gray;
}
</style>