<template>
  <v-row>
    <div class="loader" v-if="mainLoading">
      <v-progress-circular
        :size="70"
        :width="7"
        color="grey"
        indeterminate
      ></v-progress-circular>
    </div>
    <v-col cols="12" md="12" sm="12" class="pa-0 ma-0">
      <v-breadcrumbs
        class="d-block"
        dark
        v-if="mainLoading == false"
        :items="items"
        divider=">"
      ></v-breadcrumbs>
    </v-col>
    <v-col cols="12" md="12" sm="12" class="py-0 my-0">
      <div class="loader" v-if="!datas || datas.length == 0">
        <h4 class="white--text" v-if="loading == false">Not Found Result</h4>
      </div>
      <mobile-top-bar />
    </v-col>
    <v-card
      dark
      flat
      :loading="loading"
      width="100%"
      v-if="mainLoading == false"
    >
      <transition-group tag="div" class="row" name="slide-up" appear>
        <v-col
          v-for="data in datas"
          :key="data.id"
          cols="6"
          lg="2"
          md="3"
          sm="3"
          class="d-block child-flex"
        >
          <v-hover v-slot="{ hover }">
            <v-img
              :src="`/resources/${data.image_item}`"
              :lazy-src="`/resources/${data.image_item}`"
              :aspect-ratio="32 / 16"
              width="190"
              height="250"
              style="position: relative"
              :class="{ scaleImg: hover }"
            >
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular
                    indeterminate
                    color="grey lighten-5"
                  ></v-progress-circular>
                </v-row>
              </template>
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

                  <div :class="hover ? 'qview' : 'hview'">
                    <quick-view :data="data" />
                  </div>
                </div>
              </v-fade-transition>
            </v-img>
          </v-hover>
          <div>
            <h5 class="white--text font-weight-bold">{{ data.name }}</h5>
            <h6 class="grey--text" v-if="data.discount">
              <del class="mr-2">{{ data.price }}</del>
              {{ data.price - (data.price * data.discount) / 100 }} MMK
            </h6>
            <h6 class="grey--text" v-if="!data.discount">
              {{ data.price }} MMK
            </h6>
          </div>
        </v-col>
      </transition-group>
    </v-card>
    <v-col
      cols="12"
      md="12"
      sm="12"
      style="display: flex; justify-content: end; align-items: end"
      v-if="isCat"
    >
      <v-pagination
        v-if="mainLoading == false"
        :hidden="isSearch"
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
import { mapGetters } from "vuex";
import MobileTopBar from "./MobileTopBar.vue";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      items: [
        { text: "Home", disabled: false, href: "/user/index" },
        { text: this.$route.params.platform, disabled: true, href: "#" },
        { text: "Shop", disabled: true, href: "#" },
        { text: "All", disabled: true, href: "#" },
      ],
      // datas: [],
      loading: false,
      mainLoading: false,
      isCat: false,
      pagination: {
        currentPage: this.$route.params.current
          ? JSON.parse(this.$route.params.current)
          : 0,
        totalPage: this.$route.params.total
          ? JSON.parse(this.$route.params.total)
          : 1,
      },
      searchName: "",
      allDatas: [],
      manyDatas: [],
      isSearch: false,
    };
  },
  components: {
    QuickView,
    MobileTopBar,
  },
  methods: {
    async getAllProductsWithPaginate() {
      this.mainLoading = true;
      let platform = this.$route.params.platform.toUpperCase();
      await axios
        .get(
          `/user/shop/getAllProduct/${platform}?page=${this.pagination.currentPage}`
        )
        .then((resp) => {
          this.isCat = true;
          this.isSearch = false;
          this.allDatas = resp.data.data;
          this.pagination.currentPage = resp.data.current_page;
          this.pagination.totalPage = resp.data.last_page;
          this.mainLoading = false;
          this.items.pop();
          this.items = [
            ...this.items,
            { text: "All", disabled: true, href: "#" },
          ];
        });
    },
    async getAllProducts() {
      let platform = this.$route.params.platform.toUpperCase();
      await axios.get(`/user/shop/getAllProducts/${platform}`).then((resp) => {
        this.manyDatas = resp.data;
      });
    },
    onChangePage(current, total) {
      if (
        this.$route.path !=
        `/user/shop/${this.$route.params.platform}/${this.pagination.currentPage}/${this.pagination.totalPage}`
      ) {
        this.getAllProductsWithPaginate();
        this.$router.push(
          `/user/shop/${this.$route.params.platform}/${current}/${total}`
        );
      }
    },
    async getGamesByCategoryId(id, platform) {
      this.loading = true;
      await axios
        .post(`/user/shop/getGamesByCategoryId/${id}`, {
          platform: platform.toUpperCase(),
        })
        .then((resp) => {
          this.allDatas = resp.data;
          this.loading = false;
        });
    },
  },
  watch: {
    $route(to, from) {
      this.getAllProductsWithPaginate();
      this.items = [
        ...this.items,
        (this.items[1].text = this.$route.params.platform),
      ];
      this.items.pop();
    },
  },
  computed: {
    datas() {
      return this.allDatas.filter((data) => {
        return data.name.toLowerCase().includes(this.searchName.toLowerCase());
      });
    },
    ...mapGetters(["rangeData"]),
  },
  mounted() {
    this.getAllProductsWithPaginate();
    this.getAllProducts();
    eventBus.$on("getByCatId", (props) => {
      this.items.pop();
      this.getGamesByCategoryId(props.id, props.platform);
      this.items = [
        ...this.items,
        { text: props.category, disabled: true, href: "#" },
      ];
      this.isCat = false;
    });
    eventBus.$on("getAllGames", () => {
      this.getAllProductsWithPaginate();
    });
    eventBus.$on("postSearch", (searchName) => {
      this.searchName = searchName;
      if (searchName == "") {
        this.getAllProductsWithPaginate();
      } else {
        this.getAllProducts();
        this.allDatas = this.manyDatas;
        this.isSearch = true;
      }
    });
    eventBus.$on("postRange", () => {
      if (this.rangeData) {
        this.isSearch = true;
        this.allDatas = this.manyDatas.filter((data) => {
          if (
            data.price >= this.rangeData[0] &&
            data.price <= this.rangeData[1]
          ) {
            return data;
          }
        });
      }
    });
  },
};
</script>

<style>
.loader {
  width: 100%;
  height: 65vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.slide-up-enter {
  transform: translateX(20px);
  opacity: 0;
}
.slide-up-enter-active,
.slide-up-leave-active {
  transition: all 0.5s ease-out;
}
.slide-up-move {
  transition: transform 0.5s ease-out;
}
.slide-up-leave-to {
  opacity: 0;
}
.qview {
  opacity: 1;
  transition: opacity 0.5s ease;
}
.hview {
  opacity: 0;
  transition: opacity 0.5s ease;
}
</style>