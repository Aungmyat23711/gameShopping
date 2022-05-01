<template>
  <div>
    <v-dialog transition="dialog-bottom-transition" max-width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn class="ml-1" text fab v-on="on" v-bind="attrs">
          <v-icon size="30">account_circle</v-icon>
        </v-btn>
      </template>
      <template v-slot:default="dialog">
        <v-card>
          <v-toolbar>
            My Account
            <v-spacer></v-spacer>
            <v-btn @click="dialog.value = false">X</v-btn>
          </v-toolbar>
          <v-card-text class="text-center">
            <div v-if="!userData">
              <v-avatar size="100" color="black" class="mt-3">
                <span class="white--text text-h5">Login</span>
              </v-avatar>
              <br />
              <span class="black--text text-h6">Your Are Not Login</span>
            </div>
            <div v-if="userData">
              <v-avatar size="100" color="primary " class="mt-3">
                <span class="white--text text-h5"> {{ avatarWord }}</span>
              </v-avatar>
              <br />
              <span class="black--text text-h6">{{ users.email }}</span>
            </div>
          </v-card-text>
          <v-card-actions>
            <v-btn v-if="userData" class="red" dark @click="logout"
              >Logout</v-btn
            >
            <v-btn
              v-if="!userData"
              class="white--text primary"
              dark
              to="/user/login"
              @click="dialog.value = false"
              >Login</v-btn
            >
            <v-btn
              v-if="!userData"
              class="info white--text"
              dark
              to="/user/register"
              @click="dialog.value = false"
              >Register</v-btn
            >
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import { eventBus } from "../../../app";
export default {
  data() {
    return {
      users: [],
      avatarWord: "",
      loading: false,
    };
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  methods: {
    logout() {
      this.$store.dispatch("setUserData", null);
      eventBus.$emit("userislogout");
      this.users = [];
    },
    getUser() {
      window.axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${this.userData}`;
      axios.get("/api/user").then((resp) => {
        this.users = resp.data;
        let user = resp.data.name;
        let namearr = user.split(" ");
        let returnname = namearr.map((value) => value[0]);
        this.avatarWord = returnname.join("");
        console.log("getuser");
      });
    },
  },
  watch: {
    userData(next, prev) {
      if (next) {
        this.getUser();
      }
    },
  },
  mounted() {
    if (this.userData) {
      this.getUser();
    }
  },
};
</script>

<style>
</style>