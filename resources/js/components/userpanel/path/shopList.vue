<template>
  <v-row>
    <div class="loader" v-if="loading">
      <v-progress-circular
        :size="70"
        :width="7"
        color="grey"
        indeterminate
      ></v-progress-circular>
    </div>
    <v-col cols="12" md="12" sm="12" class="pa-0 ma-0" v-if="loading == false">
      <v-breadcrumbs
        class="d-block"
        dark
        :items="items"
        divider=">"
      ></v-breadcrumbs>
    </v-col>
    <v-col cols="6" md="3" sm="4" v-for="data in datas" :key="data.id">
      <div v-if="loading == false">
        <v-img
          :src="`/resources/${data.image_item}`"
          :aspect-ratio="32 / 16"
          width="190"
          height="250"
          style="position: relative"
        >
          <div class="platform ml-2">
            <v-btn dark small>{{ data.platform }}</v-btn>
          </div>
          <v-fade-transition>
            <div class="transition-fast-in-fast-out">
              <router-link
                :to="`/user/index/info/${data.id}`"
                class="d-block routelink"
              >
              </router-link>
              <quick-view :data="data"></quick-view>
            </div>
          </v-fade-transition>
        </v-img>
        <h5 class="white--text font-weight-bold">{{ data.name }}</h5>
        <h6 class="grey--text" v-if="data.discount">
          <del class="mr-2">{{ data.price }}</del>
          {{ data.price - (data.price * data.discount) / 100 }} MMK
        </h6>
        <h6 class="grey--text" v-if="!data.discount">{{ data.price }} MMK</h6>
      </div>
    </v-col>
    <v-col
      cols="12"
      md="12"
      sm="12"
      style="display: flex; justify-content: end; align-items: end"
      v-if="isCat"
    >
      <v-pagination
        v-if="loading == false"
        v-model="pagination.currentPage"
        :length="pagination.totalPage"
        prev-icon="mdi-menu-left"
        next-icon="mdi-menu-right"
        @input="onChangePage(pagination.currentPage, pagination.totalPage)"
      ></v-pagination>
    </v-col>
  </v-row>
</template>

<script>
import axios from "axios";
import { exampleMixin } from "../utils/reuseable";
import QuickView from "./quickView.vue";
import { eventBus } from "../../../app";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      items: [
        { text: "Home", disabled: false, href: "/user/index" },
        { text: "Shop", disabled: true, href: "#" },
        { text: "All", disabled: true, href: "#" },
      ],
      datas: [],
      loading: false,
      isCat: false,
      pagination: {
        currentPage: this.$route.params.current
          ? JSON.parse(this.$route.params.current)
          : 0,
        totalPage: this.$route.params.total
          ? JSON.parse(this.$route.params.total)
          : 1,
      },
    };
  },
  components: {
    QuickView,
  },
  methods: {
    async getAllProducts() {
      this.loading = true;
      let platform = this.$route.params.platform.toUpperCase();
      await axios
        .get(
          `/user/shop/getAllProduct/${platform}?page=${this.pagination.currentPage}`
        )
        .then((resp) => {
          this.isCat = true;
          this.datas = resp.data.data;
          this.pagination.currentPage = resp.data.current_page;
          this.pagination.totalPage = resp.data.last_page;
          this.loading = false;
          this.items.pop();
          this.items = [
            ...this.items,
            { text: "All", disabled: true, href: "#" },
          ];
        });
    },
    onChangePage(current, total) {
      if (
        this.$route.path !=
        `/user/shop/${this.$route.params.platform}/${this.pagination.currentPage}/${this.pagination.totalPage}`
      ) {
        this.getAllProducts();
        this.$router.push(
          `/user/shop/${this.$route.params.platform}/${current}/${total}`
        );
      }
    },
    async getGamesByCategoryId(id) {
      this.loading = true;
      await axios.get(`/user/shop/getGamesByCategoryId/${id}`).then((resp) => {
        this.datas = resp.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getAllProducts();
    eventBus.$on("getByCatId", (props) => {
      this.items.pop();
      this.getGamesByCategoryId(props.id);
      this.items = [
        ...this.items,
        { text: props.category, disabled: true, href: "#" },
      ];
      this.isCat = false;
    });
    eventBus.$on("getAllGames", () => {
      this.getAllProducts();
    });
  },
};
</script>

<style>
.loader {
  width: 100%;
  height: 50vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>