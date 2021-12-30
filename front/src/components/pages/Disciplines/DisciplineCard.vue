<template>
  <v-card class="mx-auto" :elevation="hover ? 24 : 6">
    <!--~~~~~~~~~~~~~~~~~~~~~~~~|-USER PROFILE-|~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="d-flex justify-space-between">
      <div>
        <v-card-title>
          <v-avatar height="70" width="70">
            <v-img
              class="elevation-6"
              :src="stu_profile + discipline.students.profile"
            ></v-img>
          </v-avatar>
          <v-divider
            vertical
            class="ms-5 font-weight-bold"
            color="info"
          ></v-divider>
          <!--~~~~~~~~~~~~~~~~~~~~~~~~|-STUDENT NAME & CLASS-|~~~~~~~~~~~~~~~~~~~~~~~~-->
          <span class="ms-3 font-weight-medium mt-5">
            {{ discipline.students.first_name }}
            {{ discipline.students.last_name }}
            <p class="text-overline">
              {{ discipline.students.class }}
            </p>
          </span>
        </v-card-title>
      </div>

      <div class="d-flex me-15 mt-7">
        <v-img
          width="90"
          height="90"
          src="https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_48-512.png"
        >
        </v-img>
        <span class="font-weight-bold mt-7 text-h5 orange--text text-uppercase">
          {{ discipline.discipline_type }}
        </span>
      </div>
    </div>

    <v-divider inset class="font-weight-bold"></v-divider>
    <div class="d-flex justify-space-between">
      <div class="mt-3">
        <!--~~~~~~~~~~~~~~~~~~~~~~~~|-CALENDAR-|~~~~~~~~~~~~~~~~~~~~~~~~-->
        <v-list-tile-title class="orange--text ms-5 text-overline">
          <v-icon class="orange--text ms-1">mdi-calendar-text</v-icon>
          {{ discipline.date }}
        </v-list-tile-title>
      </div>
      <div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~|-BUTTON ACTION-|~~~~~~~~~~~~~~~~~~~~~~~~-->
        <v-card-actions>
          <v-speed-dial :direction="direction">
            <template v-slot:activator>
              <v-btn icon fab small color="blue" dark @click="isTrue = !isTrue">
                <v-icon>
                  {{ isTrue ? "mdi-close" : "mdi-dots-horizontal" }}
                </v-icon>
              </v-btn>
            </template>
            <v-btn fab dark small color="red">
              <v-icon>mdi-delete-sweep</v-icon>
            </v-btn>

            <v-btn fab dark small color="indigo">
              <v-icon>mdi-account-edit</v-icon>
            </v-btn>
            <v-btn fab dark small color="orange" @click="show = !show">
              <v-icon>{{
                show ? "mdi-chevron-up" : "mdi-chevron-down"
              }}</v-icon>
            </v-btn>
          </v-speed-dial>
        </v-card-actions>
      </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~|-DETAIL CARD-|~~~~~~~~~~~~~~~~~~~~~~~~-->
    <v-slide-y-transition>
      <v-card transition="scale-transition">
        <v-card-text v-show="show">
          <div class="d-flex">
            <div>
              <v-img
                width="80"
                height="80"
                src="https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_48-512.png"
              >
              </v-img>
            </div>
            <v-divider
              vertical
              class="ms-2 font-weight-bold"
              color="#FFC107"
            ></v-divider>
            <div class="ms-5">
              <p class="font-weight-bold text-h6 orange--text">
                WARNING LETTER
              </p>
              <span class="font-weight-bold">
                <strong class="orange--text">REASON: </strong>
                {{ discipline.description }}
              </span>
            </div>
          </div>
        </v-card-text>
      </v-card>
    </v-slide-y-transition>
  </v-card>
</template>

<!--~~~~~~~~~~~~~~~~~~~~~~~~|SCRIPT|~~~~~~~~~~~~~~~~~~~~~~~~-->
<script>
export default {
  props: ["discipline", "student"],
  data() {
    return {
      stu_profile: "http://localhost:8000/storage/images/",
      show: false,
      isTrue: false,
      direction: "left",
    };
  },
};
</script>

<!--~~~~~~~~~~~~~~~~~~~~~~~~|STYLE|~~~~~~~~~~~~~~~~~~~~~~~~-->
<style scoped>
#create .v-speed-dial {
  position: absolute;
}

#create .v-btn--floating {
  position: relative;
}
</style>