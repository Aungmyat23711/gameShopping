<template>
  <div>
    <v-toolbar flat dark> </v-toolbar>
    <v-container>
      <v-row>
        <v-col cols="12" md="3">
          <v-card elevation="5">
            <v-card-text>
              <div class="display">
                <v-sheet
                  class="sheetCard d-flex justify-center align-center"
                  width="100"
                  height="100"
                  elevation="5"
                  color="orange"
                >
                  <v-icon color="#fff"> videogame_asset </v-icon>
                </v-sheet>
                <v-spacer></v-spacer>
                <div class="text-end">
                  <v-subheader>
                    <span class="h5">Games</span>
                  </v-subheader>
                  <h3 style="padding: 0 16px">
                    {{ datas ? datas.length : 0 }}
                  </h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn dark style="background: orange" @click="checkGame"
                  ><span v-if="isGame == false">Check</span></v-btn
                >
              </div>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card elevation="5">
            <v-card-text>
              <div class="display">
                <v-sheet
                  class="sheetCard d-flex justify-center align-center"
                  width="100"
                  height="100"
                  elevation="5"
                  color="#2378dc"
                >
                  <v-icon color="#fff"> face </v-icon>
                </v-sheet>
                <v-spacer></v-spacer>
                <div class="text-end">
                  <v-subheader>
                    <span class="h5">Users</span>
                  </v-subheader>
                  <h3 style="padding: 0 16px">
                    {{ users ? users.length : 0 }}
                  </h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn dark class="primary" @click="checkUser">
                  <span v-if="isUser == false">Check</span>
                </v-btn>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card elevation="5">
            <v-card-text>
              <div class="display">
                <v-sheet
                  class="sheetCard d-flex justify-center align-center"
                  width="100"
                  height="100"
                  elevation="5"
                  color="#fa05e8"
                >
                  <v-icon color="#fff"> local_shipping </v-icon>
                </v-sheet>
                <v-spacer></v-spacer>
                <div class="text-end">
                  <v-subheader>
                    <span class="h5">Orders Pending</span>
                  </v-subheader>
                  <h3 style="padding: 0 16px">
                    {{
                      orderlists
                        ? orderlists.filter((data) => data.status == "pending")
                            .length
                        : 0
                    }}
                  </h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn
                  dark
                  style="background: #ff00ff"
                  @click="checkPendingOrder"
                  ><span v-if="isPendingOrder == false">Check</span></v-btn
                >
              </div>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="3">
          <v-card elevation="5">
            <v-card-text>
              <div class="display">
                <v-sheet
                  class="sheetCard d-flex justify-center align-center"
                  width="100"
                  height="100"
                  elevation="5"
                  color="#d72835"
                >
                  <v-icon color="#fff"> delivery_dining </v-icon>
                </v-sheet>
                <v-spacer></v-spacer>
                <div class="text-end">
                  <v-subheader>
                    <span class="h5">Orders Success</span>
                  </v-subheader>
                  <h3 style="padding: 0 16px">
                    {{
                      orderlists
                        ? orderlists.filter((data) => data.status == "success")
                            .length
                        : 0
                    }}
                  </h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn
                  dark
                  style="background: #d72835"
                  @click="checkSuccessOrder"
                  ><span v-if="isSuccessOrder == false">Check</span></v-btn
                >
              </div>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="12" sm="12">
          <order-lists
            v-if="isPendingOrder"
            :orderlists="orderlists"
            :getPendingOrders="getPendingOrders"
          />
          <success-order-list v-if="isSuccessOrder" :orderlists="orderlists" />
          <game-lists v-if="isGame" :datas="datas" />
          <users-list v-if="isUser" :users="users" />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import OrderLists from "./paths/OrderLists.vue";
import SuccessOrderList from "./paths/SuccessOrderList.vue";
import GameLists from "./paths/GameLists.vue";
import UsersList from "./paths/UsersList.vue";
import { eventBus } from "../../app";

export default {
  data() {
    return {
      fullName: "",
      orderlists: [],
      isPendingOrder: false,
      isSuccessOrder: false,
      isUser: false,
      isGame: true,
      datas: [],
      users: [],
    };
  },
  computed: {
    ...mapGetters(["adminData"]),
  },
  components: {
    OrderLists,
    SuccessOrderList,
    GameLists,
    UsersList,
  },
  methods: {
    getTwo(fullname) {
      const twoName = fullname
        .toUpperCase()
        .split(" ")
        .map((name) => {
          return name[0];
        })
        .join("");
    },
    async getPendingOrders() {
      await axios.get("/admin/order/getPendingOrders").then((resp) => {
        this.orderlists = resp.data;
      });
    },
    async readGames() {
      this.loading = true;
      await axios.get("/admin/readgame").then((resp) => {
        this.datas = resp.data;
        this.loading = false;
      });
    },
    checkPendingOrder() {
      this.isPendingOrder = true;
      this.isUser = false;
      this.isSuccessOrder = false;
      this.isGame = false;
    },
    checkSuccessOrder() {
      this.isSuccessOrder = true;
      this.isPendingOrder = false;
      this.isUser = false;
      this.isGame = false;
    },
    checkGame() {
      this.isSuccessOrder = false;
      this.isPendingOrder = false;
      this.isUser = false;
      this.isGame = true;
    },
    checkUser() {
      this.isSuccessOrder = false;
      this.isPendingOrder = false;
      this.isUser = true;
      this.isGame = false;
    },
    async allusers() {
      await axios.get("/admin/dashboard/getusers").then((resp) => {
        this.users = resp.data;
      });
    },
  },

  mounted() {
    window.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${this.adminData}`;
    axios.get("/api/user").then((resp) => {
      this.fullName = resp.data.name;
      this.getTwo(this.fullName);
    });
    this.getPendingOrders();
    this.readGames();
    this.allusers();
  },
};
</script>

<style>
.sheetCard {
  top: -35px;
  position: relative;
  border-radius: 5px;
}
.display {
  display: flex;
}
</style>