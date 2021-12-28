<template>
  <div class="body">
    <div class="container p-4 mt-12">
      <v-row>
        <v-col class="card mt-12" lg="6" md="6" sm="8">
          <v-card elevation="2" shaped tile class="pa-4">
            <h3 class="font-weight-medium text-center mb-4">
              WELCOME TO STUDENT LIFE
            </h3>

            <v-alert type="error" dismissible v-if="message === 'fail'">
              Invalid Password or Email
            </v-alert>

            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                prepend-icon="mdi-email"
                required
              ></v-text-field>

              <v-text-field
                v-model="password"
                :rules="nameRules"
                label="Password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show ? 'text' : 'password'"
                prepend-icon="mdi-lock"
                required
                @click:append="show = !show"
              ></v-text-field>

              <!-- <v-btn
                  color="error"
                  class="mr-4"
                  @click="reset"
              >
                  Clear
              </v-btn> -->

              <v-btn
                :disabled="!valid"
                color="info"
                class="mr-4"
                right
                @click="validate"
              >
                Login
              </v-btn>
            </v-form>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
export default {
  emits: ["requestLogin"],
  props: ["message"],
  data: () => ({
    valid: true,
    show: false,
    password: "",
    nameRules: [
      (v) => !!v || "Password is required",
      (v) =>
        (v && v.length <= 8 && v.length >= 4) ||
        "Password must be at least 4 and less than 8 characters",
    ],
    email: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
  }),

  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        let userData = {
          email: this.email,
          password: this.password,
        };
        this.$emit("requestLogin", userData);
      }
    },
    reset() {
      this.$refs.form.reset();
    },
  },
};
</script>

<style scoped>
.card {
  margin: auto;
}
.body {
  /* background: url(https://cdn.pixabay.com/photo/2017/02/05/15/04/stones-2040340_960_720.jpg)
    fixed;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center; */
  /* min-height: 95vh; */
  /* max-height: auto; */
  background: red;
}
</style>
