<template>
  <div>
    <v-menu
      v-model="menu"
      :close-on-content-click="false"
      offset-y
      width="500px"
    >
      <template v-slot:activator="{ on }">
        <v-btn class="ml-1" text fab v-on="on" plain>
          <v-icon size="30">search</v-icon>
        </v-btn>
      </template>
      <v-card dark class="mt-5">
        <v-card-text>
          <div class="d-flex">
            <v-text-field
              v-model="searchName"
              @keyup="postSearch"
              prepend-icon="search"
              placeholder="Search Something"
            >
            </v-text-field>
            <v-select
              style="width: 100px; padding-left: 10px"
              v-model="platform"
              :items="platforms"
              menu-props="auto"
              label="Platform"
              single-line
            >
            </v-select>
          </div>
        </v-card-text>
      </v-card>
    </v-menu>
  </div>
</template>

<script>
import { eventBus } from "../../../app";
export default {
  data() {
    return {
      menu: false,
      platform: "PS4",
      searchName: "",
      platforms: ["PS4", "PS5", "PC", "XBOXONE", "XBOXS", "NINTENDO"],
    };
  },
  methods: {
    postSearch() {
      if (this.$route.path != `/user/shop/${this.platform}`) {
        this.$router.push(`/user/shop/${this.platform}`);
        eventBus.$emit("postSearch", this.searchName);
      } else {
        eventBus.$emit("postSearch", this.searchName);
      }
    },
  },
};
</script>

<style>
</style>