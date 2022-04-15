<template>
  <div>
    <div class="Wishlist" style="margin-top: 90px">
      <h4>Shopping Cart</h4>
      <v-breadcrumbs
        class="d-block"
        dark
        :items="items"
        divider=">"
      ></v-breadcrumbs>
    </div>
    <v-container>
      <v-row>
        <v-col cols="12" md="">
          <div>
            <h3 class="white--text">My Cart List</h3>
          </div>
          <v-simple-table dark>
            <thead>
              <tr>
                <td><h3>Product</h3></td>
                <td><h3>Price</h3></td>
                <td><h3>Platform</h3></td>
                <td><h3>Qty</h3></td>
                <td><h3>Actions</h3></td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="data in cartGames" :key="data.fid">
                <td style="width: 300px">
                  <v-img
                    :src="`/resources/${data.image_item}`"
                    width="100"
                    height="100"
                    class="float-left my-5"
                  >
                    <v-btn
                      fab
                      x-small
                      style="margin-left: 75px; margin-top: -10px"
                      @click="deleteCartGame(data.cartid)"
                    >
                      <v-icon>clear</v-icon>
                    </v-btn>
                  </v-img>
                  <div
                    style="height: 100%"
                    class="d-flex justify-center align-center"
                  >
                    <h4>{{ data.name }}</h4>
                  </div>
                </td>
                <td>
                  <div v-if="data.discount == 0">
                    {{ data.price }}
                  </div>
                  <div v-if="data.discount != 0">
                    {{ data.price - (data.price * data.discount) / 100 }}
                    <br />
                    {{ data.discount }} % off
                  </div>
                </td>
                <td align="center">
                  <div>{{ data.platform }}</div>
                </td>
                <td>
                  <div>
                    {{ data.cartqty }}
                  </div>
                </td>

                <td>
                  <div class="d-flex">
                    <div style="position: relative; width: 100%" class="mt-15">
                      <quick-view
                        :data="data"
                        :callAgain="callAgain"
                      ></quick-view>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </v-simple-table>
        </v-col>
        <v-col cols="12" align="end" class="justify-end">
          <v-btn dark class="ml-5" to="/user/myorders" large tile
            >Order Now</v-btn
          >
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import { exampleMixin } from "../userpanel/utils/reuseable";
import { mapGetters } from "vuex";
import axios from "axios";
import Swal from "sweetalert2";
import QuickView from "../userpanel/path/quickView.vue";
import "../../../css/app.css";
import { eventBus } from "../../app";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      cartGames: [],

      user_id: "",
      items: [
        { text: "Home", disabled: false, href: "/user/index" },
        { text: "Shopping Cart", disabled: true, href: "/user/addtocart" },
      ],
    };
  },
  components: {
    QuickView,
  },

  methods: {
    async getAddToCartGame() {
      await axios
        .get(`/user/addtocart/getCartGames/${this.user_id}`)
        .then((resp) => {
          this.cartGames = resp.data;
        });
    },
    scrollTop() {
      window.scrollTo(0, 0);
    },
    callAgain() {
      this.getAddToCartGame();
    },
    async deleteCartGame(id) {
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/user/addtocart/deleteCartGame/${id}`, formData)
        .then((resp) => {
          this.getAddToCartGame();
          eventBus.$emit("addCartList");
          const Toast = Swal.mixin({
            toast: true,
            color: "#fff",
            background: "rgb(12, 73, 20)",
            iconColor: "#fff",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            position: "top-right",
          });
          Toast.fire({
            title: "Deleted",
            icon: "success",
          });
        });
    },
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  mounted() {
    window.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${this.userData}`;
    axios.get("/api/user").then((resp) => {
      this.user_id = resp.data.id;
      this.getAddToCartGame();
    });
    this.scrollTop();
  },
};
</script>

<style>
</style>