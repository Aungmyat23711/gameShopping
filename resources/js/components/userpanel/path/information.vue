<template>
  <div>
    <v-container style="margin-top: 90px">
      <v-breadcrumbs dark :items="items" divider=">"></v-breadcrumbs>
      <v-row>
        <v-col cols="12" md="6" sm="6" lg="5">
          <div style="position: relative">
            <v-skeleton-loader
              dark
              v-if="loading"
              class="mx-auto"
              height="600"
              max-width="460"
              type="image"
            ></v-skeleton-loader>
            <v-img
              v-if="loading == false"
              :src="`/resources/${datas.image_item}`"
              :lazy-src="`/resources/${datas.image_item}`"
              :aspect-ratio="20 / 26"
              style="position: relative"
            >
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular
                    indeterminate
                    color="#fff"
                  ></v-progress-circular>
                </v-row>
              </template>
              <v-chip
                v-if="datas.discount"
                class="ma-2"
                color="green chip"
                label
                text-color="white"
              >
                <v-icon left>discount</v-icon>
                {{ datas.discount }} % off
              </v-chip>
              <v-chip
                v-if="datas.discount"
                class="ma-2"
                color="primary plat"
                label
                text-color="white"
              >
                <v-icon left>sports_esports</v-icon>
                {{ datas.platform }}
              </v-chip>
            </v-img>
            <div style="height: 100%; position: absolute; top: 45%; left: 45%">
              <v-progress-circular
                v-if="loading"
                indeterminate
                color="primary"
              ></v-progress-circular>
            </div>
          </div>
        </v-col>
        <v-col cols="12" md="6" sm="6" lg="7">
          <h2 class="h1">{{ datas.name }}</h2>
          <h2 v-if="!datas.discount" class="pink--text">
            {{ datas.price }} MMK
          </h2>
          <h3 v-if="datas.discount" class="white--text">
            <del>{{ datas.price }} MMK</del>
          </h3>
          <h2 v-if="datas.discount" class="pink--text">
            {{ Math.trunc(datas.price - (datas.price * datas.discount) / 100) }}
            MMK
          </h2>
          <p class="white--text" v-if="datas.description">
            {{ datas.description.slice(0, 200) }}...
          </p>
          <br />
          <table class="table">
            <tbody>
              <tr>
                <td width="200px">Release date</td>
                <td>{{ datas.release_date }}</td>
              </tr>
              <tr>
                <td>Developer</td>
                <td>{{ datas.developer }}</td>
              </tr>
              <tr>
                <td>Publisher</td>
                <td>{{ datas.publisher }}</td>
              </tr>
              <tr>
                <td>Game Mode</td>
                <td>{{ datas.game_mode }}</td>
              </tr>
              <tr>
                <td>Rated</td>
                <td>{{ datas.rated }}</td>
              </tr>
              <tr>
                <td>Category</td>
                <td>
                  <span v-for="cat in allCategory" :key="cat.id"
                    >{{ cat.category }},
                  </span>
                </td>
              </tr>
            </tbody>
          </table>

          <v-divider dark></v-divider>
          <v-row>
            <v-col cols="12" md="6">
              <v-btn-toggle dark tile borderless>
                <v-btn @click="qty--" :disabled="qty == 1"> - </v-btn>
                <v-text-field
                  style="width: 80px"
                  class="centered-field"
                  solo
                  min="1"
                  v-model="qty"
                ></v-text-field>
                <v-btn @click="qty++" :disabled="qty == datas.qty"> + </v-btn>
              </v-btn-toggle>
              <v-btn
                small
                class="d-block white--text"
                color="green"
                v-if="datas.qty != 0"
              >
                <span>Instock</span>
                <v-badge color="blue" :content="datas.qty"></v-badge>
              </v-btn>
              <v-btn
                small
                class="d-block white--text"
                color="orange"
                v-if="datas.qty == 0"
              >
                <span>Out of stock</span>
                <v-badge color="blue" :content="datas.qty"></v-badge>
              </v-btn>
            </v-col>
            <v-col cols="12" md="6">
              <v-btn
                tile
                large
                class="primary"
                :disabled="loading"
                :loading="cartloading"
                dark
                @click="condition == 1 ? goToCart() : addToCart()"
              >
                <v-icon>shopping_bag</v-icon>
                <span>{{ condition == 1 ? "Go To Cart" : "Add To Cart" }}</span>
              </v-btn>
              <v-btn
                text
                color="primary"
                class="mt-5"
                :disabled="loading"
                :loading="whistlistLoader"
                @click="count != 0 ? goWhistlist() : addWhistlist()"
              >
                <v-icon left>{{
                  count != 0 ? "favorite" : "favorite_border"
                }}</v-icon>
                <span>{{
                  count != 0 ? "Go to wishlist" : "Add to wishlist"
                }}</span>
              </v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="12">
          <v-tabs dark v-model="model">
            <v-tab>Description</v-tab>
            <v-tab>Additional Information</v-tab>
            <v-tab>Review</v-tab>
          </v-tabs>
          <v-tabs-items v-model="model" dark>
            <v-tab-item>
              <v-container>
                <span class="grey--text"> {{ datas.description }}</span>
              </v-container>
            </v-tab-item>
            <v-tab-item>
              <v-container>
                <v-row>
                  <v-col cols="12" md="12">
                    <v-simple-table class="black darken-2">
                      <tbody>
                        <tr>
                          <td>Game Mode</td>
                          <td>{{ datas.game_mode }}</td>
                        </tr>
                      </tbody>
                    </v-simple-table>
                  </v-col>
                </v-row>
              </v-container>
            </v-tab-item>
            <v-tab-item>
              <v-card>Hello World3</v-card>
            </v-tab-item>
          </v-tabs-items>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import "../../../../css/information.css";
import { exampleMixin } from "../utils/reuseable";
import { eventBus } from "../../../app";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      items: [{ text: "Home", disabled: false, href: "/user/index" }],
      datas: [],
      allCategory: [],
      qty: 1,
      loading: false,
      whistlistLoader: false,
      cartloading: false,
      isFav: false,
      model: null,
      user_id: "",
      count: "",
      condition: 0,
    };
  },
  methods: {
    async getByGameId() {
      this.loading = true;
      await axios
        .get(`/admin/restadd/getbyid/${this.$route.params.id}`)
        .then((resp) => {
          this.datas = resp.data[0];
          this.loading = false;

          this.items = [
            ...this.items,
            {
              text: "Shop",
              disabled: false,
              href: `/user/shop/${resp.data[0].platform}`,
            },
            { text: `${resp.data[0].name}`, disabled: true, href: "#" },
          ];
        });
    },
    async takeCategoryByGameId() {
      await axios
        .get(`/user/index/getCategory/${this.$route.params.id}`)
        .then((resp) => {
          this.allCategory = resp.data;
        });
    },

    async addWhistlist() {
      await axios
        .post("/user/information/addwhistlist", {
          user_id: this.user_id,
          game_id: this.datas.id,
        })
        .then((resp) => {
          this.isWhistList();
          eventBus.$emit("addWhistList");
        });
    },
    async isWhistList() {
      this.whistlistLoader = true;
      await axios
        .get(
          `/user/information/isWhistList/${this.$route.params.id}/${this.user_id}`
        )
        .then((resp) => {
          this.count = resp.data;
          this.whistlistLoader = false;
        });
    },
    async goWhistlist() {
      this.$router.push("/user/whishlist");
    },
    scrollTop() {
      window.scrollTo(0, 0);
    },
    async addToCart() {
      await axios
        .post("/user/index/addtocart", {
          user_id: this.user_id,
          game_id: this.datas.id,
          qty: this.qty,
        })
        .then((resp) => {
          this.checkInCart(this.datas.id);
          eventBus.$emit("addCartList");
        });
    },
    async checkInCart(id) {
      this.cartloading = true;
      await axios
        .get(`/user/information/checkincart/${id}/${this.user_id}`)
        .then((resp) => {
          this.condition = resp.data.count;
          this.cartloading = false;
        });
    },
    goToCart() {
      this.$router.push("/user/addtocart");
    },
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  mounted() {
    if (this.userData) {
      window.axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${this.userData}`;
      this.loading = true;
      axios.get("/api/user").then((resp) => {
        this.loading = false;
        this.user_id = resp.data.id;
        this.getByGameId();
        this.isWhistList();
        this.checkInCart(this.data[0].id);
      });
    } else {
      this.getByGameId();
    }

    this.takeCategoryByGameId();
    this.scrollTop();
  },
};
</script>

<style lang="scss" scoped>
</style>