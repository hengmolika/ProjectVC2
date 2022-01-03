<template>
  <div>
    <v-container>
      <v-card class="mx-auto mt-5" elevation="7">
        <div class="d-flex" id="card-student-info">
          <!--***************|-BUTTON BACK-|***************-->
          <div class="stu-img">
            <v-btn class="pa-2 mt-1 ms-1" icon color="deep-orange" dark>
              <v-icon>mdi-arrow-left-thick</v-icon>
            </v-btn>
            <!--***************|-STUDENT PROFILE-|***************-->
            <v-hover>
              <template v-slot:default="{ hover }">
                <div class="stu-profile">
                  <v-avatar height="130" width="130" class="ma-5">
                    <v-img
                      src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_0.jpg"
                    >
                    </v-img>
                    <v-fade-transition>
                      <v-overlay v-if="hover" absolute color="#036358">
                        <v-btn text fab>
                          <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                      </v-overlay>
                    </v-fade-transition>
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
                >PHEARAK ENG
              </v-list-item-title>

              <div class="d-flex">
                <!--***************|-STUDENT CLASS-|***************-->
                <div>
                  <v-list-item-subtitle class="text-overline font-weight-bold"
                    ><v-icon class="orange--text">mdi-school</v-icon> |
                    <strong class="text-overline info--text">Class: </strong>
                    WEB</v-list-item-subtitle
                  >
                </div>
                <!--***************|-STUDENT BATCH-|***************-->
                <div class="ms-5">
                  <v-list-item-subtitle class="text-overline font-weight-bold"
                    ><v-icon class="orange--text">mdi-school</v-icon> |
                    <strong class="text-overline info--text">BATCH: </strong>
                    2021</v-list-item-subtitle
                  >
                </div>
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
                Male</v-list-item-subtitle
              >
              <!--***************|-STUDENT EMAIL-|***************-->
              <v-list-item-subtitle class="color-info font-weight-bold"
                ><strong class="text-overline info--text">Email: </strong>
                phearak.eng@gmail.com</v-list-item-subtitle
              >
              <!--***************|-STUDENT PHONE NUMBER-|***************-->
              <v-list-item-subtitle class="color-info font-weight-bold"
                ><strong class="text-overline info--text"
                  >Phone number:
                </strong>
                096 680 349 / 088 459 3232</v-list-item-subtitle
              >
              <v-list-item-subtitle class="color-info font-weight-bold"
                ><strong class="text-overline info--text">Create At: </strong>
                12-20/2021</v-list-item-subtitle
              >
              <!-- <v-list-item-subtitle class="color-info"
                ><strong class="font-weight-bold text-overline"
                  >Update At:
                </strong>
                12-20/2021</v-list-item-subtitle
              > -->
            </v-list-item-content>
          </div>
        </div>
        <v-divider></v-divider>
      </v-card>
      <!--***************|-PERMISSION CARD-|***************-->
      <v-card elevation="3" class="permission-card">
        <v-tab class="mt-4 pa-5" overlap>
          <v-icon font-weight-medium class="me-2 deep-orange--text"
            >mdi-school</v-icon
          >
          <v-badge
            color="deep-orange"
            class="text-h6 font-weight-bold deep-orange--text"
            content="6"
          >
            PERMISSION
          </v-badge>
        </v-tab>
      </v-card>
      <!--***************|-DISCIPLINE CARD-|***************-->
      <v-card elevation="3" class="discipline-card">
        <v-tab class="mt-4 pa-5" overlap>
          <v-icon font-weight-medium class="me-2 orange--text"
            >mdi-school</v-icon
          >
          <v-badge
            color="warning"
            class="text-h6 font-weight-bold orange--text"
            content="2"
          >
            DISCIPLINES
          </v-badge>
        </v-tab>
      </v-card>
    </v-container>
  </div>
</template>


<script>
export default {
  data() {
    return {
      overlay: false,
    };
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
  border-left: #20de20 5px solid;
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