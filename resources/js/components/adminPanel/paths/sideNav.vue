<template>
  <div>
    <v-navigation-drawer app dark class="primary" v-model="condition">
      <div class="toptitle">
        <h3><span>Game</span><span> Shopping</span></h3>
      </div>
      <v-divider style="background: #fff"></v-divider>
      <v-list class="pa-3">
        <v-list-item
          v-for="(nav, index) in navLists"
          :key="index"
          :to="nav.link"
        >
          <v-list-item-action>
            <v-icon>{{ nav.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> {{ nav.title }} </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
import { eventBus } from "../../../app";
export default {
  data() {
    return {
      navLists: [
        { icon: "dashboard", title: "Dashboard", link: "/admin/dashboard" },
        { icon: "menu", title: "Sub Adding", link: "/admin/sub" },
        { icon: "videogame_asset", title: "Games", link: "/admin/addgame" },
      ],
      condition: true,
    };
  },
  mounted() {
    eventBus.$on("sideNav", () => {
      this.condition = !this.condition;
    });
  },
};
</script>

<style scoped>
.toptitle {
  padding: 20px 20px 0 20px;
  color: #fff;
  font-weight: bolder;
}
</style>