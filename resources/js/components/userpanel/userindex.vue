<template>
  <div class="background">
    <v-container>
      <section class="pa-0" style="height: 100%">
        <v-row>
          <v-col cols="12" md="8">
            <v-row>
              <v-col cols="12" md="12">
                <v-hover>
                  <v-carousel height="400" hide-delimiters cycle>
                    <v-carousel-item v-for="(item, i) in promotions" :key="i">
                      <v-img
                        :aspect-ratio="16 / 9"
                        :src="`/resources/${item.image}`"
                        :lazy-src="`/resources/${item.image}`"
                      >
                        <template v-slot:placeholder>
                          <v-row
                            class="fill-height ma-0"
                            align="center"
                            justify="center"
                          >
                            <v-progress-circular
                              indeterminate
                              color="grey lighten-5"
                            ></v-progress-circular>
                          </v-row>
                        </template>
                      </v-img>
                      <!-- <v-expand-transition>
                        <div
                          v-if="hover"
                          class="
                            d-flex
                            transition-fast-in-fast-out
                            darken-2
                            carouselBackground
                            v-card--reveal
                            white--text
                            text-h5
                            justify-center
                            text-center
                            align-center
                          "
                          style="height: 100%"
                        >
                          <div>
                            <v-chip
                              v-if="item.discount"
                              class="ma-2"
                              color="green"
                              label
                              text-color="white"
                            >
                              <v-icon left>discount</v-icon>
                              {{ item.discount }} % off
                            </v-chip>
                            <span class="d-block font-weight-bold text--h1">{{
                              item.name
                            }}</span>
                            <h4 v-if="item.discount">
                              <del>{{ item.price }} MMK</del>
                            </h4>
                            <h4 v-if="!item.discount">{{ item.price }} MMK</h4>
                            <h4 v-if="item.discount">
                              {{
                                Math.trunc(
                                  item.price -
                                    (item.price * item.discount) / 100
                                )
                              }}
                              MMK
                            </h4>
                          </div>
                        </div>
                      </v-expand-transition> -->
                    </v-carousel-item>
                  </v-carousel>
                </v-hover>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="12" md="4">
            <v-row>
              <v-col
                cols="12"
                md="12"
                v-for="img in datas.slice(1, 3)"
                :key="img.id"
              >
                <v-img
                  :aspect-ratio="16 / 9"
                  :src="`/resources/${img.image}`"
                  :lazy-src="`/resources/${img.image}`"
                >
                  <template v-slot:placeholder>
                    <v-row
                      class="fill-height ma-0"
                      align="center"
                      justify="center"
                    >
                      <v-progress-circular
                        indeterminate
                        color="grey lighten-5"
                      ></v-progress-circular>
                    </v-row>
                  </template>
                </v-img>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
        <v-row>
          <transition-group
            tag="div"
            class="row"
            appear
            mode="out-in"
            name="fade-up"
          >
            <v-col cols="12" md="4" v-for="list in lists" :key="list.icon">
              <v-list dark flat>
                <v-list-item>
                  <v-list-item-action>
                    <v-icon color="primary">{{ list.icon }}</v-icon>
                  </v-list-item-action>
                  <v-list-item-content>
                    <v-list-item-title class="font-weight-bold">
                      {{ list.title }}
                    </v-list-item-title>
                    <v-list-item-subtitle class="font-weight-bold">
                      {{ list.subtitle }}
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-col>
          </transition-group>
        </v-row>
        <br />
        <br />
        <div class="white--text" style="padding-left: 90px">
          <span>Recently Added</span>
          <v-divider class="mt-4" dark></v-divider>
        </div>

        <v-slide-group
          dark
          v-model="model"
          class="pa-4"
          center-active
          show-arrows
        >
          <v-slide-item
            v-for="n in datas.slice(0, 5).reverse()"
            :key="n.id"
            class="d-flex child-flex"
          >
            <v-img
              :src="`/resources/${n.image_item}`"
              :lazy-src="`/resources/${n.image_item}`"
              :alt="n.name"
              class="img ma-5"
              @mouseover="visible = n.id"
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
                <v-btn small>{{ n.platform }}</v-btn>
              </div>
              <v-fade-transition>
                <div class="transition-fast-in-fast-out">
                  <router-link
                    :to="`/user/index/info/${n.id}`"
                    class="d-block routelink"
                  >
                  </router-link>
                  <quick-view :data="n"></quick-view>
                </div>
              </v-fade-transition>
            </v-img>
          </v-slide-item>
        </v-slide-group>
      </section>
      <section>
        <div class="content-center">
          <h1>Choose Your Game Console</h1>
        </div>
        <div>
          <v-row class="modalBox">
            <v-col
              v-for="data in showBoxDatas"
              :key="data.title"
              wrap
              cols="12"
              md="4"
              :class="`${data.back} showBox`"
              @mouseover="activeClass(data.title)"
              @mouseleave="deactiveClass"
            >
              <span :class="`${data.textColor}--text showBoxText`">{{
                data.title
              }}</span>
              <div
                v-if="active == data.title"
                :class="{ 'expand-box': active == data.title }"
              >
                <v-btn :class="`${data.back}`" :to="data.link">
                  <span :class="`${data.textColor}--text`">Shop</span>
                </v-btn>
              </div>
            </v-col>
            <v-col cols="12" class="mt-5" align="center">
              <v-btn>See All</v-btn>
            </v-col>
          </v-row>
        </div>
      </section>
    </v-container>
  </div>
</template>

<script>
import QuickView from "./path/quickView.vue";
import { exampleMixin } from "../userpanel/utils/reuseable";
import "../../../css/app.css";
import { mapGetters } from "vuex";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      items: [{ text: "Home", disabled: true, href: "/user/index" }],
      visible: "",
      action: "",
      model: null,
      showBoxDatas: [
        {
          back: "blue darken-4",
          textColor: "white",
          title: "PS4",
          link: "/user/shop/ps4",
        },
        {
          back: "grey lighten-5",
          textColor: "black",
          title: "PS5",
          link: "/user/shop/ps5",
        },
        {
          back: "indigo darken-1",
          textColor: "white",
          title: "PC",
          link: "/user/shop/pc",
        },
        {
          back: "green darken-3",
          textColor: "white",
          title: "XBOX ONE",
          link: "/user/shop/xboxone",
        },
        {
          back: "green lighten-1",
          textColor: "black",
          title: "XBOX S",
          link: "/user/shop/xboxs",
        },
        {
          back: "red darken-4",
          textColor: "white",
          title: "NINTENDO",
          link: "/user/shop/nintendo",
        },
      ],
      lists: [
        {
          icon: "local_shipping",
          title: "FREE SHIPPING & RETURN",
          subtitle: "Free shipping on all orders over 5000 MMk",
        },
        {
          icon: "paid",
          title: "MONEY BACK GUARANTEE",
          subtitle: "100% money back guarantee",
        },
        {
          icon: "more_time",
          title: "ONLINE SUPPORT 24/7",
          subtitle: "Online supporting 24 hour every day",
        },
      ],
      datas: [],

      categories: [],
      newDatas: [],
      allCategory: [],
      platforms: [],
      quickPlatform: "",
      active: "",
      user_id: "",
      promotions: [{ image: "discount.jpg" }, { image: "itemsekio.jpg" }],
    };
  },
  components: {
    QuickView,
  },
  computed: {
    ...mapGetters(["userData"]),
  },
  methods: {
    activeClass(title) {
      this.active = title;
    },
    deactiveClass() {
      this.active = "";
    },

    async getData() {
      await axios.get("/admin/readgame").then((resp) => {
        // this.datas = resp.data;
        this.datas = resp.data.filter(
          (val) => val.platform.toUpperCase() == "PS4" && val
        );
      });
    },
    async getDataByUserId() {
      await axios
        .get(`/user/index/getDataByUserId/${this.user_id}`)
        .then((resp) => {
          this.datas = resp.data;
        });
    },
    scrollToTop() {
      window.scrollTo(0, 0);
    },
  },
  mounted() {
    if (this.userData) {
      window.axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${this.userData}`;
      axios.get("/api/user").then((resp) => {
        this.user_id = resp.data.id;
        // this.getDataByUserId();
      });
      this.getData();
    } else {
      this.getData();
    }

    this.scrollToTop();
  },
};
</script>

<style scoped>
h1 {
  color: rgb(128, 128, 128);
  padding-bottom: 30px;
  text-align: center;
  word-spacing: 2px;
  letter-spacing: 1px;
}
h1:after {
  content: " ";
  display: block;
  width: 150px;
  height: 2px;
  margin: 0 auto;
  background-color: blue;
  margin-top: 30px;
}
</style>