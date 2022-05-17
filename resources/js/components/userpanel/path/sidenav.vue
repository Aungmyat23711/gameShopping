<template>
  <v-navigation-drawer disable-resize-watcher app dark v-model="drawer">
    <v-container>
      <div style="width: 100%" class="d-flex justify-end align-end">
        <v-btn x-small fab color="red" @click="drawer = false">
          <v-icon>clear</v-icon>
        </v-btn>
      </div>
      <v-list v-for="list in lists" :key="list.title">
        <v-list-item :to="list.link">
          <v-list-item-action>
            <v-icon>{{ list.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ list.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-container>
  </v-navigation-drawer>
</template>

<script>
import { eventBus } from "../../../app";
export default {
  data() {
    return {
      drawer: false,
      lists: [
        { title: "Home", link: "/user/index", icon: "home" },
        { title: "PS4", link: "/user/shop/PS4", icon: "sports_esports" },
        { title: "PS5", link: "/user/shop/PS5", icon: "sports_esports" },
        { title: "PC", link: "/user/shop/PC", icon: "sports_esports" },
        {
          title: "XBOXONE",
          link: "/user/shop/XBOXONE",
          icon: "sports_esports",
        },
        { title: "XBOXS", link: "/user/shop/XBOXS", icon: "sports_esports" },
        {
          title: "NINTENDO",
          link: "/user/shop/NINTENDO",
          icon: "sports_esports",
        },
        {
          title: "My Orders",
          link: "/user/myorderlists",
          icon: "all_inbox",
        },
      ],
    };
  },
  mounted() {
    eventBus.$on("clickIcon", () => {
      this.drawer = !this.drawer;
    });
  },
};
</script>

<style>
</style>