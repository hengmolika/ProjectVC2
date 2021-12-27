<template>
  <!--~!~!~!~!~!~!~!~!~!~!~|CARD|~!~!~!~!~!~!~!~!~!~!~-->

  <v-hover v-slot="{ hover }" class="mt-10">
    <v-card
      id="card"
      class="mx-auto"
      max-width="auto"
      :elevation="hover ? 24 : 6"
      :class="{ 'on-hover': hover }"
    >
      <v-list-item>
        <!--USER PROFILE-->
        <v-list-item-avatar height="80" width="80" class="mb-14">
          <v-img
            size="100"
            src="../../../assets/student-life-removebg-preview.png"
          >
          </v-img>
        </v-list-item-avatar>
        <v-list-item-content>
          <div class="text-overline mb-1">{{ permission.id }}</div>
          <!--STUDENT NAME-->
          <v-list-item-title class="text-h5">
            Molika {{ permission.id }} {{ permission.id }}
          </v-list-item-title>

          <!--REQUEST-->
          <v-list-item-title class="text-h7 mb-1 text-overline">
            <strong class="text-overline mb-1">Leave type:</strong>
            {{ permission.reason }}
          </v-list-item-title>

          <!--DATE TIME -->
          <v-divider class="mt-2"></v-divider>
          <v-list-item-subtitle class="mt-2">
            <!-- <strong> Leave At: </strong> 12/Oct/2021 | 9:30AM | -->
            <v-icon>mdi-calendar-text</v-icon>
            <strong>Start: {{ permission.start_date }}</strong> 3 |DAY
            <strong>Come back: {{ permission.end_date }}</strong>
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <!--BTN HOVER-->
      <v-card-actions class="text-right">
        <v-btn
          icon
          :class="{ 'show-btn-detail': hover }"
          :color="transparent"
          @click="reveal = true"
        >
          <v-icon :class="{ 'show-btn-detail': hover }" :color="transparent">
            mdi-eye
          </v-icon>
        </v-btn>
        <v-btn icon :class="{ 'show-btn-edit': hover }" :color="transparent">
          <v-icon :class="{ 'show-btn-edit': hover }" :color="transparent">
            mdi-pencil
          </v-icon>
        </v-btn>

        <v-btn icon :class="{ 'show-btn-remove': hover }" :color="transparent">
          <v-icon :class="{ 'show-btn-remove': hover }" :color="transparent">
            mdi-delete
          </v-icon>
        </v-btn>
      </v-card-actions>
      <!--BTN HOVER-->
      <v-expand-transition>
        <v-card
          v-if="reveal"
          class="transition-fast-in-fast-out v-card--reveal"
          height="100%"
        >
          <v-card-text class="pb-0">
            <p class="text-h4 text--primary">DISCRIPTION</p>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero
              quibusdam accusamus quam sit quia expedita facere. Ut excepturi,
              minus maiores fugit rerum soluta dignissimos reprehenderit
              mollitia. Eligendi maxime minima veniam!
            </p>
          </v-card-text>
          <v-card-actions class="pt-0">
            <v-btn text color="teal accent-4" @click="reveal = false">
              Close
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-expand-transition>
    </v-card>
  </v-hover>

  <!--~!~!~!~!~!~!~!~!~!~|BTN CREATE|~!~!~!~!~!~!~!~!~!~-->
  <!-- <v-btn class="mb-10" bottom color="deep-orange" dark fab fixed right>
    <v-icon>mdi-plus</v-icon>
  </v-btn> -->
</template>

<!--~!~!~!~!~!~!~!~!~!~!~|SCRIPT|~!~!~!~!~!~!~!~!~!~!~-->
<script>
export default {
  props: ["permission"],

  data() {
    return {
      transparent: "rgba(255, 255, 255, 0)",
    };
  },
  computed: {},
  methods: {},
};
</script>


<!--~!~!~!~!~!~!~!~!~!~!~|STYLE|~!~!~!~!~!~!~!~!~!~!~-->
<style scoped>
.wrapper {
  background: url(https://cdn.pixabay.com/photo/2016/08/11/23/48/mountains-1587287_960_720.jpg)
    fixed;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  height: 100vh;
}

#card {
  border-left: 10px solid #4281f5;
}

h3 {
  font-weight: 400;
}

.show-btn-detail {
  color: white !important;
  background: #4281f5;
}

.show-btn-remove {
  color: red !important;
  background: #4281f5;
}

.show-btn-edit {
  color: #20de20 !important;
  background: #4281f5;
}
</style>