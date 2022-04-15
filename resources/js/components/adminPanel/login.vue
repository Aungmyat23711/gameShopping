<template>
  <div class="loginframe">
    <v-card class="primary" width="400px">
      <v-card-title class="justify-center">
        <p class="text-danger" v-text="errors.email"></p>
        <p class="text-danger" v-text="errors.password"></p>
        <h2>Sign In</h2>
      </v-card-title>
      <v-card-text class="text-center">
        <transition name="avatar" mode="out-in" appear>
          <v-avatar size="100">
            <img
              src="https://media.istockphoto.com/vectors/user-icon-flat-isolated-on-white-background-user-symbol-vector-vector-id1300845620?b=1&k=20&m=1300845620&s=170667a&w=0&h=JbOeyFgAc6-3jmptv6mzXpGcAd_8xqkQa_oUK2viFr8="
              alt=""
            />
          </v-avatar>
        </transition>
        <v-divider dark></v-divider>
        <v-text-field
          height="55"
          placeholder="Enter Your Email"
          prepend-inner-icon="email"
          solo
          v-model="form.email"
        >
        </v-text-field>
        <v-text-field
          height="55"
          placeholder="Enter Your Password"
          prepend-inner-icon="lock"
          :type="isClickPass ? 'password' : 'text'"
          :append-icon="isClickPass ? 'visibility_off' : 'visibility'"
          @click:append="isClickPass = !isClickPass"
          solo
          v-model="form.password"
        >
        </v-text-field>
        <v-btn @click="login" width="100%" class="mb-2">Login</v-btn>
        <h5 style="color: #fff">If you have account, please</h5>
        <v-btn class="primary" outlined dark width="100%">Register</v-btn>
      </v-card-text>
      <v-card-actions class="justify-center"> </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import axios from "axios";
import "../../../css/login.css";
export default {
  data() {
    return {
      isClickPass: false,
      form: {
        email: "",
        password: "",
      },
      errors: {},
    };
  },
  methods: {
    async login() {
      await axios
        .post("/api/login", this.form)
        .then((resp) => {
          this.$store.dispatch("setAdminData", resp.data);
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>