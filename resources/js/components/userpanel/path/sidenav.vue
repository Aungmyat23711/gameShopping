<template>
  <v-navigation-drawer disable-resize-watcher app dark v-model="drawer">
    <v-container>
      <div style="width: 100%" class="d-flex justify-end align-end">
        <v-btn x-small fab color="red" @click="drawer = false">
          <v-icon>clear</v-icon>
        </v-btn>
      </div>
      <v-list>
        <v-list-item>
          <v-list-item-action>
            <v-icon>home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
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