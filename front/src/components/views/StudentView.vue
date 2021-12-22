<template>
  <div class="team">
    <v-container>
      <v-layout row>
        <v-flex>
          <v-card class="ma-3" elevation="7">
            <v-list-item>
              <v-avatar size="70">
                <img src="../../../public/lady.jpeg" alt="" />
              </v-avatar>
              <v-list-item-content>
                <div class="overline ms-10 text-left">STUDENT</div>
                <v-list-item-title
                  class="headline mb-1 ms-10 text-left"
                  elevation="10"
                  >PHEARAK ENG</v-list-item-title
                >
                <div><v-divider></v-divider></div>
              </v-list-item-content>
            </v-list-item>

            <v-card-actions>
              <v-icon text class="ma-2">mdi-email</v-icon>
              <div class="overline">
                phearak.eng@student.passerlessnumeriues.org
              </div>
            </v-card-actions>
            <div class="pa-2 ma-2 text-right">
              <v-btn color="success" class="ms-100">
                <v-icon> mdi-pencil </v-icon> EDIT
              </v-btn>
              <v-btn color="warning" class="ms-2"> REMOVE </v-btn>
            </div>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  name: "team",
  components: {},
};
</script>
