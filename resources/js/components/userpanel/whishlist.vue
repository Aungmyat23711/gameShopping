<template>
  <div>
    <div class="Wishlist" style="margin-top: 90px">
      <h4>Wishlist</h4>
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
            <h3 class="white--text">My WhishList</h3>
          </div>
          <v-simple-table dark>
            <thead>
              <tr>
                <td><h3>Product</h3></td>
                <td><h3>Price</h3></td>
                <td><h3>Platform</h3></td>
                <td><h3>Stock Status</h3></td>
                <td><h3>Actions</h3></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="5" align="center">
                  <v-progress-circular
                    :size="40"
                    v-if="loading"
                    :width="7"
                    color="#fff"
                    indeterminate
                  ></v-progress-circular>
                </td>
              </tr>
              <tr v-for="data in whishlists" :key="data.fid">
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
                      @click="deleteWhishList(data.fid)"
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
                  <div v-if="data.qty != 0">
                    <v-btn small color="info">instock</v-btn>
                  </div>
                  <div v-if="data.qty == 0">
                    <v-btn small color="red">out of stock</v-btn>
                  </div>
                </td>

                <td>
                  <div>
                    <div style="position: relative; width: 100%" class="mt-15">
                      <quick-view :data="data"></quick-view>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </v-simple-table>
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
      whishlists: [],
      categories: [],
      user_id: "",
      loading: false,
      platforms: "",
      platform: "",
      items: [
        { text: "Home", disabled: false, href: "/user/index" },
        { text: "Whishlist", disabled: true, href: "/user/whishlist" },
      ],
    };
  },
  components: {
    QuickView,
  },

  methods: {
    async getWhishList() {
      this.loading = true;
      await axios
        .get(`/user/whishlist/getwhishlist/${this.user_id}`)
        .then((resp) => {
          this.whishlists = resp.data;
          this.loading = false;
        });
    },
    async deleteWhishList(id) {
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/user/whishlist/delete/${id}`, formData)
        .then((resp) => {
          this.getWhishList();
          eventBus.$emit("addWhistList");
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
    scrollTop() {
      window.scrollTo(0, 0);
    },
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  mounted() {
    window.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${this.userData}`;
    if (this.userData) {
      axios.get("/api/user").then((resp) => {
        this.user_id = resp.data.id;
        this.getWhishList();
      });
    }
    this.scrollTop();
    eventBus.$on("userislogout", () => {
      this.whishlists = [];
    });
  },
};
</script>

<style>
</style>