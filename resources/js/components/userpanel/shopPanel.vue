<template>
  <div class="pa-0" style="margin-top: 90px">
    <v-navigation-drawer
      v-model="drawer"
      stateless
      class="sidenav"
      dark
      height="100%"
    >
      <v-expansion-panels v-model="panel" tile>
        <v-expansion-panel>
          <v-expansion-panel-header> Categories </v-expansion-panel-header>
          <v-expansion-panel-content>
            <div class="pa-2">
              <span class="caption">All</span>
              <span>
                <v-chip x-small @click="getAllGames"> {{ allCount }}</v-chip>
              </span>
            </div>
            <div v-for="category in categories" :key="category.id" class="pa-2">
              <span class="caption">{{ category.category }}</span>
              <span
                ><v-chip
                  x-small
                  @click="gameController(category.id, category.category)"
                  >{{ getTotalCategory(category.id) }}</v-chip
                ></span
              >
            </div>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-navigation-drawer>

    <shop-list />
  </div>
</template>

<script>
import axios from "axios";
import { eventBus } from "../../app";
import ShopList from "./path/shopList.vue";
export default {
  data() {
    return {
      categories: [],
      panel: 0,
      allTotalCategoies: [],
      drawer: true,
      allGamesByCatId: [],
      allCount: 0,
    };
  },
  components: {
    ShopList,
  },
  methods: {
    async readCategory() {
      await axios.get("/admin/sub/category/read").then((resp) => {
        this.categories = resp.data;
      });
    },
    async getCategoryCount() {
      let platform = this.$route.params.platform.toUpperCase();
      await axios.get(`/user/shop/getCount/${platform}`).then((resp) => {
        this.allTotalCategoies = resp.data;
      });
    },
    getTotalCategory(id) {
      let data = this.allTotalCategoies.filter((val) => {
        if (val.category_id == id) return val;
      });
      return data.length;
    },
    gameController(id, category) {
      eventBus.$emit("getByCatId", { id, category });
    },

    scrollToTop() {
      window.scrollTo(0, 0);
    },
    async getAlldata() {
      await axios.get("/admin/readgame").then((resp) => {
        this.allCount = resp.data.length;
      });
    },
    getAllGames() {
      eventBus.$emit("getAllGames");
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