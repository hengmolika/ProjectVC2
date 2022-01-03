<template>
  <div id="app" class="overflow-hidden">
    <v-app id="inspire" class="mt-3">
      <v-row>
        <v-col cols="12" lg="12" md="12" sm="12" xs="12">
          <v-card elevation="24" class="mx-auto">
            <v-system-bar lights-out></v-system-bar>
            <v-carousel
              cycle
              height="300"
              hide-delimiter-background
              show-arrows-on-hover
            >
              <v-carousel-item v-for="(value, i) in values" :key="i">
                <v-sheet :color="colors[i]" height="100%" tile>
                  <v-row class="fill-height" align="center" justify="center">
                    <div class="text-h3 font-weight-regular white--text">
                      {{ value }}
                    </div>
                  </v-row>
                </v-sheet>
              </v-carousel-item>
            </v-carousel>
            <v-list two-line>
              <v-list-item>
                <v-list-item-avatar width="70" height="70">
                  <v-img
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    size="1000"
                  ></v-img>
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title
                    class="info--text font-weight-medium text-h5"
                    >PASSERELLES NUMERIQUES CAMBODIA</v-list-item-title
                  >
                  <v-list-item-subtitle
                    class="orange--text font-weight-medium text-h6"
                    >STUDENT LIFE</v-list-item-subtitle
                  >
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
      <!--**********************************|SUB CARD|***********************************-->
      <template>
        <div class="team">
          <v-container>
            <v-layout row wrap>
              <v-flex sm6 xs12 md6 lg3>
                <v-card class="ma-3">
                  <v-list-item>
                    <v-list-item-avatar tile class="mt-n7">
                      <v-sheet
                        color="green"
                        width="80"
                        height="80"
                        elevation="10"
                      >
                        <v-icon dark large>mdi-store</v-icon>
                      </v-sheet>
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <div class="overline text-right">List of students</div>
                      <v-list-item-title class="headline mb-1 text-right"
                        >313.230.00</v-list-item-title
                      >
                      <div><v-divider></v-divider></div>
                    </v-list-item-content>
                  </v-list-item>
                  <v-card-actions>
                    <v-icon text class="ma-2">mdi-school</v-icon>
                    <div class="overline">STUDENT</div>
                  </v-card-actions>
                </v-card>
              </v-flex>
              <v-flex sm6 xs12 md6 lg3>
                <v-card class="ma-3">
                  <v-list-item>
                    <v-list-item-avatar tile class="mt-n7">
                      <v-sheet
                        color="#03A9F4"
                        width="80"
                        height="80"
                        elevation="10"
                      >
                        <v-icon dark large>mdi-school</v-icon>
                      </v-sheet>
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <div class="overline text-right">STUDENT ALUMNI</div>
                      <v-list-item-title class="headline mb-1 text-right"
                        >234.233.000</v-list-item-title
                      >
                      <div><v-divider></v-divider></div>
                    </v-list-item-content>
                  </v-list-item>
                  <v-card-actions>
                    <v-icon text class="ma-2">mdi-school</v-icon>
                    <div class="overline">GRADUATED</div>
                  </v-card-actions>
                </v-card>
              </v-flex>
              <v-flex sm6 xs12 md6 lg3>
                <v-card class="ma-3">
                  <v-list-item>
                    <v-list-item-avatar tile class="mt-n7">
                      <v-sheet
                        color="#F44336"
                        width="80"
                        height="80"
                        elevation="10"
                      >
                        <v-icon dark large>mdi-shopping</v-icon>
                      </v-sheet>
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <div class="overline text-right">Shopping</div>
                      <v-list-item-title class="headline mb-1 text-right"
                        >$34,245</v-list-item-title
                      >
                      <div><v-divider></v-divider></div>
                    </v-list-item-content>
                  </v-list-item>
                  <v-card-actions>
                    <v-icon text class="ma-2">mdi-ticket-account</v-icon>
                    <div class="overline">VISA Card</div>
                  </v-card-actions>
                </v-card>
              </v-flex>
              <v-flex sm6 xs12 md6 lg3>
                <v-card class="ma-3">
                  <v-list-item>
                    <v-list-item-avatar tile class="mt-n7">
                      <v-sheet
                        color="#FFC107"
                        width="80"
                        height="80"
                        elevation="10"
                      >
                        <v-icon dark large>mdi-contacts</v-icon>
                      </v-sheet>
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <div class="overline text-right">Folder shared</div>
                      <v-list-item-title class="headline mb-1 text-right"
                        >1730</v-list-item-title
                      >
                      <div><v-divider></v-divider></div>
                    </v-list-item-content>
                  </v-list-item>
                  <v-card-actions>
                    <v-icon text class="ma-2">mdi-folder</v-icon>
                    <div class="overline">Prodect</div>
                  </v-card-actions>
                </v-card>
              </v-flex>
              <v-flex
                xs12
                sm6
                md4
                lg3
                v-for="person in team"
                :key="person.name"
              >
                <v-card class="text-center ma-3">
                  <v-responsive class="pt-4">
                    <v-avatar size="100" class="red lighten-2">
                      <img :src="person.avatar" alt="" />
                    </v-avatar>
                  </v-responsive>
                  <v-card-text>
                    <div class="subheading">{{ person.name }}</div>
                    <div class="grey--text">{{ person.role }}</div>
                  </v-card-text>
                  <v-card-actions>
                    <v-btn outlined color="orange">
                      <v-icon small left>mdi-message</v-icon>
                      <span>Message</span>
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-flex>
            </v-layout>
          </v-container>
        </div>
      </template>
      <!--*****************************|~GRAP~|*****************************-->
      <template>
        <div class="d-flex">
          <v-card class="mx-auto text-center" width="650">
            <v-card-text>
              <v-sheet color="info">
                <v-sparkline
                  :value="permission"
                  color="rgba(255, 255, 255, .7)"
                  height="100"
                  padding="24"
                  stroke-linecap="round"
                  smooth
                >
                  <template v-slot:label="item"> {{ item.value }} % </template>
                </v-sparkline>
              </v-sheet>
            </v-card-text>

            <v-card-text>
              <div class="text-h5">STUDENT PERMISSION</div>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions class="justify-center">
              <v-btn block color="info" dark> Go to Report </v-btn>
            </v-card-actions>
          </v-card>
          <v-card class="mx-auto text-center" width="650">
            <v-card-text>
              <v-sheet color="purple">
                <v-sparkline
                  :value="discipline"
                  color="rgba(255, 255, 255, .7)"
                  height="100"
                  padding="24"
                  stroke-linecap="round"
                  smooth
                >
                  <template v-slot:label="item"> {{ item.value }} % </template>
                </v-sparkline>
              </v-sheet>
            </v-card-text>

            <v-card-text>
              <div class="text-h5">STUDENT DISCIPLINE</div>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions class="justify-center">
              <v-btn block color="purple" dark> Go to Report </v-btn>
            </v-card-actions>
          </v-card>
        </div>
      </template>
    </v-app>
  </div>
</template>

<script>
export default {
  name: "team",
  data() {
    return {
      colors: ["warning", "info", "warning", "info", "warning"],
      cycle: false,
      values: [
        "TRUST",
        "RESPONSIBILITY",
        "SOLIDARITY",
        "RESPECT",
        "DEMANDING APPROACH",
      ],
      permission: [423, 446, 675, 510, 590, 610, 760, 900],
      discipline: [30, 46, 75, 80, 979, 160, 890, 900],

      cards: [
        {
          title: "Pre-fab homes",
          src: "https://cdn.vuetifyjs.com/images/cards/house.jpg",
          flex: 6,
        },
        {
          title: "Favorite road trips",
          src: "https://cdn.vuetifyjs.com/images/cards/road.jpg",
          flex: 6,
        },
        {
          title: "Best airlines",
          src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
          flex: 6,
        },
      ],
      team: [
        { name: "SIM HUL", role: "EDUCATION TEAM", avatar: "/img1.png" },
        { name: "RONAN ORGOR", role: "WEB TRAINER", avatar: "/img2.png" },
        { name: "MOK PISET", role: "ERO TEAM", avatar: "/img3.png" },
        {
          name: "SOKHOM HEANG",
          role: "TECHNICAL TEAM",
          avatar: "/img4.png",
        },
      ],
    };
  },
};
</script>


<style scoped>
</style>