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
                  <h3 style="padding: 0 16px">100</h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn dark style="background: orange">Check</v-btn>
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
                  <h3 style="padding: 0 16px">100</h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn dark class="primary">Check</v-btn>
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
                  <h3 style="padding: 0 16px">100</h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn dark style="background: #ff00ff">Check</v-btn>
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
                    <span class="h5">Orders</span>
                  </v-subheader>
                  <h3 style="padding: 0 16px">100</h3>
                </div>
              </div>
              <div class="text-center">
                <v-btn dark style="background: #d72835">Check</v-btn>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      fullName: "",
    };
  },
  computed: {
    ...mapGetters(["adminData"]),
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
  },

  mounted() {
    window.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${this.adminData}`;
    axios.get("/api/user").then((resp) => {
      this.fullName = resp.data.name;
      this.getTwo(this.fullName);
    });
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