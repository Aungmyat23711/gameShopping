<template>
  <div>
    <v-container>
      <v-row>
        <!--- Platform -->
        <platform></platform>
        <!--- Voice -->
        <voice></voice>
        <!--- Edition -->
        <edition></edition>
        <!--- Category -->
        <category></category>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import platform from "./paths/platform.vue";
import Voice from "./paths/voice.vue";
import Edition from "./paths/edition.vue";
import Category from "./paths/category.vue";
export default {
  components: { platform, Voice, Edition, Category },
  data() {
    return {};
  },
};
</script>

<style>
</style>