<template>
  <div>
    <v-app>
      <header>
        <v-app-bar height="auto" dark fixed elevate-on-scroll>
          <v-container class="d-flex py-0">
            <v-app-bar-nav-icon
              @click="clickIcon"
              class="hidden-md-and-up"
            ></v-app-bar-nav-icon>
            <v-toolbar-title class="mr-10 hidden-sm-and-down">
              <span class="d-block h1 font-weight-bold">Game</span>
              <span>Shopping</span>
            </v-toolbar-title>
            <v-btn-toggle borderless tile class="hidden-sm-and-down">
              <v-hover v-slot="{ hover }">
                <v-btn
                  to="/user/index"
                  exact-active-class="activeClass"
                  active-class="activeClass"
                  height="80"
                  width="150"
                  :style="{ 'background-color': hover ? '#4653b9' : '' }"
                >
                  <v-icon left>home</v-icon>
                  <span>Home</span>
                </v-btn>
              </v-hover>

              <v-menu open-on-hover offset-y transition="slide-x-transition">
                <template v-slot:activator="{ on }">
                  <v-hover v-slot="{ hover }">
                    <v-btn
                      id="removeClass"
                      :ripple="false"
                      height="80"
                      width="150"
                      v-on="on"
                      :style="{ 'background-color': hover ? '#4653b9' : '' }"
                    >
                      <v-icon class="pl-3" left>sports_esports</v-icon>
                      <span>Platforms</span>
                      <v-icon>expand_more</v-icon>
                    </v-btn>
                  </v-hover>
                </template>
                <v-card class="mt-1" dark>
                  <v-card-text>
                    <v-list v-for="link in links" :key="link.title">
                      <v-list-item :to="link.link">
                        <v-list-item-content>
                          <v-list-item-title>
                            {{ link.title }}
                          </v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                    </v-list>
                  </v-card-text>
                </v-card>
              </v-menu>
              <v-hover v-slot="{ hover }">
                <v-btn
                  exact-active-class="activeClass"
                  active-class="activeClass"
                  height="80"
                  width="150"
                  :style="{ 'background-color': hover ? '#4653b9' : '' }"
                  to="/user/myorderlists"
                >
                  <v-icon left>all_inbox</v-icon>
                  <span>My Orders</span>
                </v-btn>
              </v-hover>
            </v-btn-toggle>
          </v-container>
          <v-spacer></v-spacer>

          <div class="d-flex">
            <search />
            <Useraccount />
            <v-dialog max-width="600" height="600">
              <template v-slot:activator="{ on }">
                <v-badge color="primary" :content="whishlists" dark overlap>
                  <v-btn
                    plain
                    class="ml-1"
                    text
                    fab
                    v-on="!userData ? on : null"
                    :to="!userData ? '#' : '/user/whishlist'"
                  >
                    <v-icon size="30">favorite</v-icon>
                  </v-btn>
                </v-badge>
                <v-badge color="primary" :content="cartlists" dark overlap>
                  <v-btn
                    plain
                    class="ml-1"
                    text
                    fab
                    v-on="!userData ? on : null"
                    :to="!userData ? '#' : '/user/addtocart'"
                  >
                    <v-icon size="30">shopping_basket</v-icon>
                  </v-btn>
                </v-badge>
              </template>
              <template v-slot:default="dialog">
                <login-card :dialog="dialog" />
              </template>
            </v-dialog>
          </div>
        </v-app-bar>
        <side-nav></side-nav>
      </header>
      <v-main>
        <div style="margin-top: 60px">
          <router-view></router-view>
        </div>
      </v-main>
      <v-footer dark class="px-0">
        <div class="footer-top">
          <v-row>
            <v-col cols="12" md="12">
              <v-btn to="/user/myorderlists" text>My Orders</v-btn>
              <v-btn to="/user/whishlist" text>Favourate List</v-btn>
              <v-btn to="/user/addtocart" text>Shooping Basket</v-btn>
            </v-col>
          </v-row>
        </div>
        <div class="footer-middle">
          <v-row>
            <v-col cols="12" md="6">
              <div class="d-flex">
                <div class="d-flex justify-center align-center">
                  <v-toolbar-title class="mr-3">
                    <span class="d-block h1 font-weight-bold">Game</span>
                    <span>Shopping</span>
                  </v-toolbar-title>
                </div>

                <v-divider
                  style="height: 100px; margin-right: 30px"
                  dark
                  vertical
                ></v-divider>
                <div class="d-flex justify-center align-center">
                  <v-btn small fab outlined color="primary" class="ml-5">
                    <i
                      class="fa-brands fa-facebook"
                      style="font-size: 25px"
                    ></i>
                  </v-btn>
                  <v-btn small fab outlined class="ml-5" color="pink">
                    <i
                      class="fa-brands fa-instagram"
                      style="font-size: 25px"
                    ></i>
                  </v-btn>
                  <v-btn small fab outlined class="ml-5" color="blue lighten-3">
                    <i class="fa-brands fa-twitter" style="font-size: 25px"></i>
                  </v-btn>
                  <v-btn small fab outlined class="ml-5" color="red darken-4">
                    <i class="fa-solid fa-at" style="font-size: 25px"></i>
                  </v-btn>
                </div>
              </div>
            </v-col>
            <v-col cols="12" md="6">
              <div class="footer-left">
                <ul class="footer">
                  <li>
                    <i
                      class="fa-brands fa-cc-paypal"
                      style="font-size: 40px"
                    ></i>
                  </li>
                  <li>
                    <i class="fa-brands fa-cc-visa" style="font-size: 40px"></i>
                  </li>
                  <li>
                    <i
                      class="fa-brands fa-cc-mastercard"
                      style="font-size: 40px"
                    ></i>
                  </li>
                </ul>
              </div>
            </v-col>
          </v-row>
        </div>
        <div class="footer-bottom">
          <v-row>
            <v-col cols="12" md="12">
              <v-subheader>
                ammgyi@copyright 2022. All Right Reserved.
              </v-subheader>
            </v-col>
          </v-row>
        </div>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
import "../../../css/header.css";
import { eventBus } from "../../app";
import SideNav from "../userpanel/path/sidenav.vue";
import { mapGetters } from "vuex";
import axios from "axios";
import Useraccount from "./path/useraccount.vue";
import LoginCard from "./path/LoginCard.vue";
import Search from "./path/search.vue";
export default {
  data() {
    return {
      toggle_exclusive: [],
      navRight: [
        { icon: "account_circle", to: "/user/auth" },
        { icon: "search", to: "/user/shop" },
        { icon: "favorite", to: "/user/favorite" },
      ],
      whishlists: "0",
      cartlists: "0",
      user_id: "",
      links: [
        { title: "PS4", link: "/user/shop/PS4" },
        { title: "PS5", link: "/user/shop/PS5" },
        { title: "PC", link: "/user/shop/PC" },
        { title: "XBOX ONE", link: "/user/shop/XBOXONE" },
        { title: "XBOX S", link: "/user/shop/XBOXS" },
        { title: "NINTENDO", link: "/user/shop/NINTENDO" },
      ],
    };
  },
  components: {
    SideNav,
    Useraccount,
    Search,
    LoginCard,
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  methods: {
    clickIcon() {
      eventBus.$emit("clickIcon");
    },
    async getWhishListCount(uid) {
      await axios.get(`/user/index/getwhishlistcount/${uid}`).then((resp) => {
        this.whishlists = resp.data.toString();
        console.log("whistlistcount");
      });
    },
    getUser() {
      window.axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${this.userData}`;
      axios.get("/api/user").then((resp) => {
        if (resp.data.id) {
          this.user_id = resp.data.id;
        } else {
          this.user_id = 0;
        }
        this.getWhishListCount(this.user_id);
        this.getCartLists(this.user_id);
      });
    },
    async getCartLists(uid) {
      await axios.get(`/user/index/getcartlistcount/${uid}`).then((resp) => {
        this.cartlists = resp.data.toString();
        console.log("cartlistcount");
      });
    },
    // goLogin(dialog) {
    //   dialog.value = false;
    //   this.$router.push("/user/login");
    // },
  },
  watch: {
    userData(next, prev) {
      if (next) {
        this.getUser();
      }
    },
  },
  mounted() {
    if (this.userData) {
      this.getUser();
      eventBus.$on("userislogout", () => {
        this.whishlists = "0";
        this.cartlists = "0";
      });
      eventBus.$on("addWhistList", () => {
        this.getUser();
      });
      eventBus.$on("addCartList", () => {
        this.getUser();
      });
    }
  },
};
</script>

<style>
.footer-top,
.footer-middle {
  border-bottom: 0.5px solid rgb(70, 69, 69);
  padding: 20px 0;
  width: 100%;
}
.footer {
  list-style: none;
}
.footer li {
  display: inline-block;
}
.footer-left {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  height: 100px;
}
@media only screen and (max-width: 1000px) {
  .footer-left {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    height: 100px;
  }
}
.footer-bottom {
  width: 100%;
}
</style>