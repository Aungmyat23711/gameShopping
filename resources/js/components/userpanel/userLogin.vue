<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12" md="4" offset-md="4">
          <v-form>
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
                >
                </v-text-field>
                <v-btn class="primary mb-3" style="width: 100%" @click="login"
                  >Login</v-btn
                >
                <span>If you don't have account! Please</span>
                <v-btn class="success" style="width: 100%">Register</v-btn>
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
export default {
  data() {
    return {
      isClick: false,
      form: {
        email: "",
        password: "",
      },
    };
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  methods: {
    async login() {
      await axios
        .post("/api/loginUser", this.form)
        .then((resp) => {
          this.$store.dispatch("setUserData", resp.data);
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        });
    },
  },
  mounted() {
    window.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${this.userData}`;
    axios.get("/api/user").then((resp) => {
      console.log(resp.data);
    });
  },
};
</script>

<style>
</style>