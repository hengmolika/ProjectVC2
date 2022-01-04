<template>
  <div>
    <v-container>
      <v-card class="mx-auto mt-5" elevation="7">
        <div class="d-flex" id="card-student-info">
          <!--***************|-BUTTON BACK-|***************-->
          <div class="stu-img">
            <v-btn
              class="pa-2 mt-1 ms-1"
              icon
              color="deep-orange"
              dark
              @click="prevRoutePath"
            >
              <v-icon>mdi-arrow-left-thick</v-icon>
            </v-btn>
            <!--***************|-STUDENT PROFILE-|***************-->
            <v-hover>
              <template>
                <div class="stu-profile">
                  <v-avatar height="130" width="130" class="ma-5">
                    <v-img :src="url + studentById.profile"> </v-img>
                    <!-- <v-fade-transition>
                      <v-overlay v-if="hover" absolute color="#036358">
                        <v-btn text fab>
                          <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                      </v-overlay>
                    </v-fade-transition> -->
                  </v-avatar>
                </div>
              </template>
            </v-hover>
          </div>
          <!--***************|-STUDENT INFO-|***************-->
          <div class="ms-5">
            <v-list-item-content class="border-bottom-of-student">
              <!--***************|-STUDENT NAME-|***************-->
              <v-list-item-title class="text-h5 info--text"
                >{{ studentById.first_name }} {{ studentById.last_name }}
              </v-list-item-title>

              <div class="d-flex">
                <!--***************|-STUDENT CLASS-|***************-->
                <div>
                  <v-list-item-subtitle class="text-overline font-weight-bold"
                    ><v-icon class="orange--text">mdi-school</v-icon> |
                    <strong class="text-overline info--text">Class: </strong>
                    {{ studentById.class }}</v-list-item-subtitle
                  >
                </div>
                <!--***************|-STUDENT BATCH-|***************-->
                <!-- <div class="ms-5">
                  <v-list-item-subtitle class="text-overline font-weight-bold"
                    ><v-icon class="orange--text">mdi-school</v-icon> |
                    <strong class="text-overline info--text">BATCH: </strong>
                    2021</v-list-item-subtitle
                  >
                </div> -->
                <!--***************|-SCHOOL-|***************-->
                <div class="ms-5">
                  <v-list-item-subtitle class="text-overline font-weight-bold"
                    ><v-icon class="orange--text">mdi-school</v-icon> |
                    <strong class="text-overline info--text">AT: </strong>
                    Passerelles Numeriques Cambodia</v-list-item-subtitle
                  >
                </div>
              </div>
            </v-list-item-content>

            <!-- <v-divider></v-divider> -->

            <v-list-item-content>
              <!--***************|-STUDENT SEX-|***************-->
              <v-list-item-subtitle class="color-info font-weight-bold"
                ><strong class="text-overline info--text">Gender: </strong>
                {{ studentById.gender }}</v-list-item-subtitle
              >
              <!--***************|-STUDENT EMAIL-|***************-->
              <!-- <v-list-item-subtitle class="color-info font-weight-bold"
                ><strong class="text-overline info--text">Email: </strong>
                phearak.eng@gmail.com</v-list-item-subtitle
              > -->
              <!--***************|-STUDENT PHONE NUMBER-|***************-->
              <v-list-item-subtitle class="color-info font-weight-bold"
                ><strong class="text-overline info--text"
                  >Phone number:
                </strong>
                {{ studentById.phone }}</v-list-item-subtitle
              >
            </v-list-item-content>
          </div>
        </div>
        <v-divider></v-divider>
      </v-card>
      <!--***************|-PERMISSION CARD-|***************-->
      <v-card elevation="3" class="permission-card">
        <v-tab class="mt-4 pa-5" overlap>
          <v-icon font-weight-medium class="me-2 primary--text"
            >mdi-school</v-icon
          >
          <v-badge
            color="warning"
            class="text-h6 font-weight-bold primary--text"
            :content="
              studentById.permissions.length === 0
                ? '0'
                : studentById.permissions.length
            "
          >
            PERMISSION
          </v-badge>
        </v-tab>
      </v-card>
      <v-alert outlined class="mt-4" color="purple">
        <student-permission
          v-for="permission of studentById.permissions"
          :key="permission.id"
          :permission="permission"
          :student="studentById"
        >
        </student-permission>
      </v-alert>
      <!--***************|-DISCIPLINE CARD-|***************-->
      <v-card elevation="3" class="discipline-card">
        <v-tab class="mt-4 pa-5" overlap>
          <v-icon font-weight-medium class="me-2 primary--text"
            >mdi-school</v-icon
          >
          <v-badge
            color="error"
            class="text-h6 font-weight-bold primary--text"
            :content="
              studentById.disciplines.length === 0
                ? '0'
                : studentById.disciplines.length
            "
          >
            DISCIPLINES
          </v-badge>
        </v-tab>
      </v-card>
      <v-alert outlined class="mt-4" color="purple">
        <student-discipline
          v-for="discipline of studentById.disciplines"
          :key="discipline.id"
          :discipline="discipline"
          :student="studentById"
        >
        </student-discipline>
      </v-alert>
    </v-container>
  </div>
</template>

<script>
import axios from "../../api/api.js";
import StudentPermission from "../pages/studentDetail/studentPermission.vue";
import StudentDiscipline from "../pages/studentDetail/studentDiscipline.vue";
export default {
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      vm.prevRoute = from;
    });
  },
  props: ["studentId"],
  components: {
    "student-permission": StudentPermission,
    "student-discipline": StudentDiscipline,
  },
  data() {
    return {
      props: ["studentId"],
      url: "http://localhost:8000/storage/images/",
      overlay: false,
      studentById: [],
      permissions: [],
      disciplines: [],
    };
  },
  methods: {
    prevRoutePath() {
      if(this.prevRoute.path === "/student") {
        this.$router.push("/student")
      } else if(this.prevRoute.path === "/permision") {
        this.$router.push("/permision")
      } else if(this.prevRoute.path === "/discipline") {
        this.$router.push("/discipline")
      } else {
        this.$router.push("/student");
      }

    }
  },
  mounted() {
    if (localStorage.userId) {
      axios.get("/students/" + this.studentId).then((res) => {
        this.studentById = res.data;
      });

      axios.get("/permissions").then((res) => {
        this.permissions = res.data;
      });

      axios.get("/disciplines").then((res) => {
        this.disciplines = res.data;
      });
    }
  },
};
</script>

<style scoped>
/* .stu-img {
  background: orange;
} */
.border-bottom-of-student {
  border-bottom: 2px solid orange;
  border-radius: 10px;
}
.permission-card {
  border-left: orange 5px solid;
}
.discipline-card {
  border-left: red 5px solid;
}

/* ........................|-RESPONSIVE-|........................ */
@media only screen and (min-width: 600px) {
  /* FOR CARD STUDENT INFO */
  #card-student-info {
    display: inline-block;
    /* width: 100%; */
  }
}
</style>
