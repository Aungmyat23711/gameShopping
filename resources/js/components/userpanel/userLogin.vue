<template>
  <div>
    <v-container class="pt-10">
      <v-row>
        <v-col cols="12" md="4" offset-md="4">
          <v-form ref="form">
            <v-card>
              <v-card-title class="justify-center">
                <span>User Login</span>
              </v-card-title>
              <v-card-text>
                <v-subheader>
                  <span>Email</span>
                </v-subheader>
                <v-text-field
                  v-model="form.email"
                  solo
                  label="Enter Your Email"
                  prepend-inner-icon="mail"
                  required
                  :rules="emailError"
                >
                </v-text-field>
                <v-subheader>
                  <span>Password</span>
                </v-subheader>
                <v-text-field
                  v-model="form.password"
                  solo
                  label="Enter Your Password"
                  :type="isClick ? 'text' : 'password'"
                  @click:append="isClick = !isClick"
                  prepend-inner-icon="lock"
                  :append-icon="isClick ? 'visibility' : 'visibility_off'"
                  :rules="passwordError"
                >
                </v-text-field>
                <v-btn class="primary mb-3" style="width: 100%" @click="login"
                  >Login</v-btn
                >
                <span>If you don't have account! Please</span>
                <v-btn class="success" style="width: 100%" to="/user/register"
                  >Register</v-btn
                >
              </v-card-text>
            </v-card>
          </v-form>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import { eventBus } from "../../app";
export default {
  data() {
    return {
      isClick: false,
      form: {
        email: "",
        password: "",
      },
      emailError: [
        (v) => !!v || "Email is required",
        (v) =>
          !v ||
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "E-mail must be valid",
      ],
      passwordError: [(v) => !!v || "Password is required"],
    };
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  methods: {
    async login() {
      if (this.$refs.form.validate()) {
        await axios
          .post("/api/loginUser", this.form)
          .then((resp) => {
            this.$store.dispatch("setUserData", resp.data);
            this.$router.push("/user/index");
            eventBus.$emit("addWhistList");
            eventBus.$emit("addCartList");
          })
          .catch((errors) => {
            this.errors = errors.response.data.errors;
          });
      }
    },
  },
  mounted() {
    if (this.userData) {
      window.axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${this.userData}`;
      axios.get("/api/user").then((resp) => {
        console.log(resp.data);
      });
    }
  },
};
</script>

<style>
</style>