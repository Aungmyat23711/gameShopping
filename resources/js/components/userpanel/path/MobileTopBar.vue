<template>
  <div class="hidden-md-and-up">
    <v-row>
      <v-col cols="6" class="py-0 my-0">
        <v-select
          class="mt-5"
          dark
          v-model="select"
          :items="categories"
          item-text="category"
          label="Category"
          hide-details
          @change="changing"
        >
        </v-select>
      </v-col>
      <v-col cols="6" class="py-0 my-0">
        <span v-if="rangeData" class="caption white--text"
          >Price {{ rangeData[0] }} MMK - {{ rangeData[1] }} MMK</span
        >
        <div class="d-flex">
          <v-range-slider
            @change="sliding"
            :value="rangeData"
            :max="max"
            :min="min"
            hide-details
            step="10"
            class="align-center"
            dark
          >
          </v-range-slider>
          <v-btn text class="mb-10" dark small @click="filter">Filter</v-btn>
        </div>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { shopPanel } from "../utils/reuseableShopPanel";
export default {
  mixins: [shopPanel],
  computed: {
    ...mapGetters(["rangeData"]),
  },
  data() {
    return {
      select: "All",
      categories: [],
      min: 0,
      max: 300000,
    };
  },
  methods: {
    changing() {
      alert("change");
    },
    sliding(event) {
      this.$store.dispatch("setRangeData", event);
    },
    async readCategory() {
      await axios.get("/admin/sub/category/read").then((resp) => {
        this.categories = resp.data;
        this.categories.unshift({ category: "All" });
      });
    },
  },
  mounted() {
    this.readCategory();
  },
};
</script>

<style>
</style>