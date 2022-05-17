<template>
  <div class="pa-0" style="margin-top: 90px">
    <v-navigation-drawer
      v-model="drawer"
      stateless
      class="sidenav hidden-sm-and-down"
      dark
      height="100%"
    >
      <v-expansion-panels dark v-model="panel" multiple tile>
        <v-expansion-panel>
          <v-expansion-panel-header> Categories </v-expansion-panel-header>
          <v-expansion-panel-content>
            <div class="pa-2">
              <span class="caption">All</span>
              <span>
                <v-chip x-small @click="getAllGames">
                  <v-progress-circular
                    indeterminate
                    color="black"
                    :width="3"
                    :size="10"
                    v-if="loading"
                  ></v-progress-circular>
                  {{ loading == false ? allCount : null }}</v-chip
                >
              </span>
            </div>
            <!-- <div class="pa-2">
              <span class="caption">Discount</span>
              <span>
                <v-chip x-small @click="getAllDiscount">
                  <v-progress-circular
                    indeterminate
                    color="black"
                    :width="3"
                    :size="10"
                    v-if="loading"
                  ></v-progress-circular>
                  {{ loading == false ? allCount : null }}</v-chip
                >
              </span>
            </div> -->
            <div
              v-for="category in categories.slice(1, categories.length)"
              :key="category.id"
              class="pa-2"
            >
              <span class="caption">{{ category.category }}</span>
              <span>
                <v-chip
                  x-small
                  @click="gameController(category.id, category.category)"
                >
                  <v-progress-circular
                    indeterminate
                    color="black"
                    :width="3"
                    :size="10"
                    v-if="loading"
                  ></v-progress-circular>

                  {{ loading == false ? getTotalCategory(category.id) : null }}
                </v-chip></span
              >
            </div>
          </v-expansion-panel-content>
        </v-expansion-panel>
        <v-expansion-panel>
          <v-expansion-panel-header> Filter Price </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-range-slider
              @change="slideRange"
              :value="rangeData"
              :max="max"
              :min="min"
              step="10"
              class="align-center"
            >
            </v-range-slider>
            <span v-if="rangeData" class="caption"
              >Price {{ rangeData[0] }} MMK - {{ rangeData[1] }} MMK</span
            >
            <v-btn @click="filter">Filter</v-btn>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-navigation-drawer>

    <shop-list />
  </div>
</template>

<script>
import axios from "axios";

import ShopList from "./path/shopList.vue";

import { shopPanel } from "./utils/reuseableShopPanel";
import { mapGetters } from "vuex";
export default {
  mixins: [shopPanel],
  data() {
    return {
      min: 0,
      max: 300000,
      categories: [],
    };
  },
  computed: {
    ...mapGetters(["rangeData"]),
  },
  components: {
    ShopList,
  },
  methods: {
    slideRange(event) {
      this.$store.dispatch("setRangeData", event);
    },
    async readCategory() {
      await axios.get("/admin/sub/category/read").then((resp) => {
        this.categories = resp.data;
        this.categories.unshift({ category: "All" });
      });
    },
  },
  watch: {
    $route(to, from) {
      this.readCategory();
      this.getCategoryCount();
      this.scrollToTop();
      this.getAlldata();
    },
  },
  mounted() {
    this.readCategory();
    this.getCategoryCount();
    this.scrollToTop();
    this.getAlldata();
  },
};
</script>

<style scoped>
/* .container {
  display: flex;
  padding: 0;
  margin: 0;
  justify-content: space-around;
} */
.sidenav {
  float: left;
  height: 100% !important;
}
@media (min-width: 300px) and (max-width: 900px) {
  .sidenav {
    float: none;
  }
}
</style>