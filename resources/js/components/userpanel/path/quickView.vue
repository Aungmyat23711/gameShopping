<template>
  <v-dialog max-width="900">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        v-on="on"
        v-bind="attrs"
        class="primary img-btn"
        tile
        large
        width="100%"
        @click="data.cartqty ? checkQty(data.cartqty) : null"
      >
        Quick View
      </v-btn>
    </template>
    <template v-slot:default="dialog">
      <v-card dark>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="6" class="d-flex child-flex">
              <v-img
                :src="`/resources/${data.image_item}`"
                :lazy-src="`/resources/${data.image_item}`"
                :aspect-ratio="15 / 22"
                style="position: relative"
              >
                <template v-slot:placeholder>
                  <v-row
                    class="fill-height ma-0"
                    align="center"
                    justify="center"
                  >
                    <v-progress-circular
                      indeterminate
                      color="#fff"
                    ></v-progress-circular>
                  </v-row>
                </template>
                <v-chip
                  v-if="data.discount"
                  class="ma-2"
                  color="green chip"
                  label
                  text-color="white"
                >
                  <v-icon left>discount</v-icon>
                  {{ data.discount }} % off
                </v-chip>
                <v-chip
                  class="ma-2 plat"
                  color="primary chip"
                  label
                  text-color="white"
                >
                  <v-icon left>sports_esports</v-icon>
                  {{ data.platform }}
                </v-chip>
              </v-img>
            </v-col>
            <v-col cols="12" md="6">
              <h2 v-if="!data.discount" class="pink--text">
                {{ data.price }} MMK
              </h2>
              <h3 v-if="data.discount">
                <del>{{ data.price }} MMK</del>
              </h3>
              <h2 v-if="data.discount" class="pink--text">
                {{
                  Math.trunc(data.price - (data.price * data.discount) / 100)
                }}
                MMK
              </h2>
              <p>{{ data.description.slice(0, 400) }}...</p>
              <br />
              <table class="table">
                <tbody>
                  <tr>
                    <td width="100px">Release date</td>
                    <td>{{ data.release_date }}</td>
                  </tr>
                  <tr>
                    <td>Developer</td>
                    <td>{{ data.developer }}</td>
                  </tr>
                  <tr>
                    <td>Publisher</td>
                    <td>{{ data.publisher }}</td>
                  </tr>
                  <tr>
                    <td>Game Mode</td>
                    <td>{{ data.game_mode }}</td>
                  </tr>
                  <tr>
                    <td>Rated</td>
                    <td>{{ data.rated }}</td>
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
                  <v-btn-toggle tile borderless>
                    <v-btn @click="qty--" :disabled="qty == 0"> - </v-btn>
                    <v-text-field
                      style="width: 80px"
                      class="centered-field"
                      solo
                      min="0"
                      v-model="qty"
                    ></v-text-field>
                    <v-btn @click="increaseQty"> + </v-btn>
                  </v-btn-toggle>
                  <span class="d-block red--text font-weight-bold">
                    {{ qtyError }}
                  </span>
                </v-col>
                <v-col cols="12" md="6">
                  <v-btn
                    tile
                    large
                    class="primary"
                    dark
                    @click="
                      condition == 1
                        ? updateCart(data.cartid, dialog)
                        : addToCart(dialog)
                    "
                  >
                    <v-icon>shopping_bag</v-icon>
                    <span>{{
                      condition == 1 ? "Update Cart" : "Add To Cart"
                    }}</span>
                  </v-btn>
                  <v-btn
                    tile
                    large
                    class="primary mt-3"
                    dark
                    @click="
                      $route.path == '/user/addtocart'
                        ? (dialog.value = false)
                        : goToCart()
                    "
                  >
                    <v-icon>shopping_bag</v-icon>
                    <span>Go To Cart</span>
                  </v-btn>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="dialog.value = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </template>
  </v-dialog>
</template>

<script>
import { mapGetters } from "vuex";
import { eventBus } from "../../../app";
import { exampleMixin } from "../utils/reuseable";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      qty: 0,
      allCategory: [],
      user_id: "",
      condition: 0,
      qtyError: "",
    };
  },
  props: ["data", "callAgain"],
  methods: {
    scrollTop() {
      window.scrollTo(0, 0);
    },
    checkQty(cartqty) {
      this.qty = cartqty;
    },
    async addToCart(dialog) {
      if (this.qty != 0) {
        await axios
          .post("/user/index/addtocart", {
            user_id: this.user_id,
            game_id: this.data.id,
            qty: this.qty,
          })
          .then((resp) => {
            dialog.value = false;
            eventBus.$emit("addCartList");
          });
      } else {
        this.qtyError = "Please Choose At Least One Item";
      }
    },

    async updateCart(id, dialog) {
      if (this.qty != 0) {
        let formData = new FormData();
        formData.append("user_id", this.user_id);
        formData.append("game_id", this.data.id);
        formData.append("qty", this.qty);
        formData.append("_method", "PUT");
        await axios
          .post(`/user/index/updatecart/${id}`, formData)
          .then((resp) => {
            this.callAgain();
            dialog.value = false;
          });
      } else {
        this.qtyError = "Please Choose At Least One Item";
      }
    },
    goToCart() {
      this.$router.push("/user/addtocart");
    },
    async checkInCart() {
      this.cartloading = true;
      await axios
        .get(`/user/information/checkincart/${this.data.id}/${this.user_id}`)
        .then((resp) => {
          this.condition = resp.data.count;
          if (resp.data.qty[0]) {
            this.qty = resp.data.qty[0];
          } else {
            this.qty = 0;
          }
          this.cartloading = false;
        });
    },
    increaseQty() {
      this.qty++;
      this.qtyError = "";
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
      axios.get("/api/user").then((resp) => {
        this.user_id = resp.data.id;
        this.checkInCart();
      });
    }
    this.takeCategoryByGameId(this.data.id);
    this.scrollTop();
  },
};
</script>

<style>
</style>