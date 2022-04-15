<template>
  <div>
    <v-app>
      <header>
        <v-app-bar app class="primary" dark>
          <v-toolbar-title>
            <v-app-bar-nav-icon @click="openClose"></v-app-bar-nav-icon>
            <v-avatar size="60">
              <img src="/resources/gameicon.png" alt="gameicon" />
            </v-avatar>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <div v-if="!adminData">
            <v-btn class="mr-3" to="/admin/login">Sign In</v-btn>
            <v-btn class="mr-3" to="/admin/register">Register</v-btn>
          </div>
          <div v-if="adminData">
            <v-btn @click="logout">Logout</v-btn>
          </div>

          <!-- <v-btn>
            <v-icon>search</v-icon>
          </v-btn> -->
        </v-app-bar>
        <side-nav></side-nav>
      </header>
      <v-main> <router-view></router-view></v-main>

      <v-footer> </v-footer>
    </v-app>
  </div>
</template>

<script>
import sideNav from "./paths/sideNav.vue";
import { eventBus } from "../../app";
import { mapGetters } from "vuex";
export default {
  methods: {
    openClose() {
      eventBus.$emit("sideNav");
    },
    logout() {
      this.$store.dispatch("setAdminData", null);
    },
  },
  computed: {
    ...mapGetters(["adminData"]),
  },
  components: { sideNav },
};
</script>

<style>
</style>