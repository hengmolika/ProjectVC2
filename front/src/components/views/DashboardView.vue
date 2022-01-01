<template>
  <div id="app" class="overflow-hidden">
    <v-app id="inspire">
      <!-- <v-banner class="mt-1 mb-1" elevation="12">
        
      <div class="d-flex flex-column  align-center">
        <v-img
          src="https://www.passerellesnumeriques.org/misc/logo-en.png"
        ></v-img>
      </div>
      </v-banner> -->

      <v-row>
        <v-col cols="12" lg="12" md="12" sm="12" xs="12">
          <v-card elevation="24"  class="mx-auto">
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
                <v-list-item-avatar>
                  <v-img
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    size="500"
                  ></v-img>
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title
                    >PASSERELLES NUMERIQUES CAMBODIA</v-list-item-title
                  >
                  <v-list-item-subtitle>STUDENT LIFE</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
      <!--*****************************|~CARD~|*****************************-->
      <template>
        <v-container>
          <v-layout>
            <v-row>
              <v-col cols="6" lg="4" md="4" sm="6" xs="12">
                <v-card class="mx-auto mt-3 mb-3" max-width="400">
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/DSC_2053.jpg"
                  >
                    <v-card-title>Top 10 Australian beaches</v-card-title>
                  </v-img>

                  <v-card-subtitle class="pb-0"> Number 10 </v-card-subtitle>

                  <v-card-text class="text--primary">
                    <div>Whitehaven Beach</div>

                    <div>Whitsunday Island, Whitsunday Islands</div>
                  </v-card-text>

                  <v-card-actions>
                    <v-btn color="info" text> Share </v-btn>

                    <v-btn color="info" text> Explore </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
              <v-col cols="6" lg="4" md="4" sm="6" xs="12">
                <v-card class="mx-auto mt-3 mb-3" max-width="400">
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    src="https://media-exp1.licdn.com/dms/image/C4E1BAQEL9_UKiZEjcg/company-background_10000/0/1557127841108?e=2159024400&v=beta&t=-QTeY0iL-YCRm9SjiRjHa-8gRx0rfc6MOSCtahQFgAg"
                  >
                    <v-card-title>Top 10 Australian beaches</v-card-title>
                  </v-img>

                  <v-card-subtitle class="pb-0"> Number 10 </v-card-subtitle>

                  <v-card-text class="text--primary">
                    <div>Whitehaven Beach</div>

                    <div>Whitsunday Island, Whitsunday Islands</div>
                  </v-card-text>

                  <v-card-actions>
                    <v-btn color="info" text> Share </v-btn>

                    <v-btn color="info" text> Explore </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
              <v-col cols="6" lg="4" md="4" sm="6" xs="12">
                <v-card class="mx-auto mt-3 mb-3" max-width="400">
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/PNC_students_outside_classroom_2015-96.jpg"
                  >
                    <v-card-title>Top 10 Australian beaches</v-card-title>
                  </v-img>

                  <v-card-subtitle class="pb-0"> Number 10 </v-card-subtitle>

                  <v-card-text class="text--primary">
                    <div>Whitehaven Beach</div>

                    <div>Whitsunday Island, Whitsunday Islands</div>
                  </v-card-text>

                  <v-card-actions>
                    <v-btn color="info" text> Share </v-btn>

                    <v-btn color="info" text> Explore </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
              <!-- <v-card class="mx-auto mt-3 mb-3" max-width="400">
                <v-img
                  class="white--text align-end"
                  height="200px"
                  src="https://cdn.pixabay.com/photo/2014/12/16/22/25/sunset-570881_960_720.jpg"
                >
                  <v-card-title>Top 10 Australian beaches</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0"> Number 10 </v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>Whitehaven Beach</div>

                  <div>Whitsunday Island, Whitsunday Islands</div>
                </v-card-text>

                <v-card-actions>
                  <v-btn color="info" text> Share </v-btn>

                  <v-btn color="info" text> Explore </v-btn>
                </v-card-actions>
              </v-card> -->
            </v-row>
          </v-layout>
        </v-container>
      </template>

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
                      <div class="overline text-right">Article</div>
                      <v-list-item-title class="headline mb-1 text-right"
                        >523614</v-list-item-title
                      >
                      <div><v-divider></v-divider></div>
                    </v-list-item-content>
                  </v-list-item>
                  <v-card-actions>
                    <v-icon text class="ma-2">mdi-account</v-icon>
                    <div class="overline">Iyad</div>
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
                        <v-icon dark large>mdi-facebook</v-icon>
                      </v-sheet>
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <div class="overline text-right">Abonné</div>
                      <v-list-item-title class="headline mb-1 text-right"
                        >+700</v-list-item-title
                      >
                      <div><v-divider></v-divider></div>
                    </v-list-item-content>
                  </v-list-item>
                  <v-card-actions>
                    <v-icon text class="ma-2">mdi-facebook</v-icon>
                    <div class="overline">AAE IdeaPro</div>
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