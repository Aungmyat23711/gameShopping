<template>
  <div>
    <div class="Wishlist" style="margin-top: 90px">
      <h4>My Order Lists</h4>
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
                <td colspan="2"><h3>Product</h3></td>
                <td><h3>Price</h3></td>
                <td><h3>Platform</h3></td>
                <td><h3>Qty</h3></td>
                <td><h3>Status</h3></td>
                <td><h3>Order Time</h3></td>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!userData">
                <td colspan="7" align="center" style="height: 100px">
                  <h3>There is no data in list because you are not login!</h3>
                  <v-btn color="primary" text to="/user/login">Go Login</v-btn>
                </td>
              </tr>
              <tr v-for="order in myorders" :key="order.id">
                <td style="width: 150px">
                  <v-img
                    :src="`/resources/${order.image_item}`"
                    width="100"
                    height="100"
                    class="float-left my-5"
                  >
                  </v-img>
                </td>
                <td>
                  <h4>{{ order.name }}</h4>
                </td>
                <td>{{ order.price }} MMK</td>
                <td>{{ order.platform }}</td>
                <td>{{ order.qty }}</td>
                <td>
                  <v-btn
                    x-small
                    :class="order.status == 'pending' ? 'orange' : 'green'"
                    >{{ order.status }}</v-btn
                  >
                </td>
                <td>{{ time(order.created_at) }}</td>
              </tr>
            </tbody>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";
import Swal from "sweetalert2";
import moment from "moment";
import "../../../css/app.css";
import { eventBus } from "../../app";
export default {
  data() {
    return {
      myorders: [],
      loading: false,
      user_id: "",
      fab: true,
      items: [
        { text: "Home", disabled: false, href: "/user/index" },
        { text: "My Orders", disabled: true, href: "/user/myorderslist" },
      ],
    };
  },
  methods: {
    async readByUserId() {
      await axios.get(`/user/getmyorderlist/${this.user_id}`).then((resp) => {
        this.myorders = resp.data;
      });
    },
    time(time) {
      return moment(time).fromNow();
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
        this.readByUserId();
      });
    }
  },
};
</script>

<style>
</style>