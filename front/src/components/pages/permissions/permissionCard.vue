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
          <v-img size="100" :src="url + permission.students.profile"> </v-img>
        </v-list-item-avatar>
        <v-list-item-content class="ml-10">
          <div class="mb-1 text-h6">
            {{ permission.students.class }}
          </div>
          <!--STUDENT NAME-->
          <div class="d-flex">
            <v-list-item-title class="text-h5 orange--text">
              {{ permission.students.first_name }}
              {{ permission.students.last_name }}
            </v-list-item-title>
            <v-list-item-title class="text-h5 orange--text flex-end">
              3 Days
            </v-list-item-title>
          </div>

          <!--REQUEST-->
          <v-list-item-content class="text-h6 mb-1">
            Leave Type: {{ permission.reason }}
          </v-list-item-content>

          <!--DATE TIME -->
          <v-divider class="mt-2"></v-divider>
          <v-list-item-subtitle class="mt-2 d-flex">
            <!-- <strong> Leave At: </strong> 12/Oct/2021 | 9:30AM | -->
            <div class="text-h6">
              Start:
              <v-icon class="blue--text">mdi-calendar-text</v-icon>
              <strong> {{ permission.start_date }} </strong>
            </div>
            <div class="text-h6 ml-10">
              Come back:
              <v-icon class="red--text">mdi-calendar-text</v-icon>
              <strong> {{ permission.end_date }}</strong>
            </div>
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
        <v-btn
          icon
          :class="{ 'show-btn-edit': hover }"
          :color="transparent"
          @click.prevent="editPermission(permission)"
        >
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
            <p class="text-h4 text--primary">Discription</p>
            <p>
              {{ permission.description }}
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
</template>

<!--~!~!~!~!~!~!~!~!~!~!~|SCRIPT|~!~!~!~!~!~!~!~!~!~!~-->
<script>
export default {
  props: ["permission","student"],
  emits: ["permissiontEdit"],

  data() {
    return {
      transparent: "rgba(255, 255, 255, 0)",
      url: "http://localhost:8000/storage/images/",
    };
  },
  computed: {},
  methods: {
    editPermission(permission) {
      this.$emit("permissiontEdit", permission);
      console.log("permission edit",permission)
    },
  },
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