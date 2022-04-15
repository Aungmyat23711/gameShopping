<template>
  <v-dialog max-width="900">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        v-on="on"
        v-bind="attrs"
        @click="takeCategory(data.game_id)"
        class="primary img-btn"
        tile
        large
        width="100%"
      >
        Quick View
      </v-btn>
    </template>
    <template v-slot:default="dialog">
      <v-card dark>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="6">
              <v-img
                :src="`/resources/${data.image_item}`"
                :aspect-ratio="15 / 22"
                style="position: relative"
              >
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
                <!-- <v-chip
                  v-if="platform"
                  class="ma-2 plat"
                  color="primary chip"
                  label
                  text-color="white"
                >
                  <v-icon left>sports_esports</v-icon>
                  {{ platform }}
                </v-chip> -->
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
                      <span
                        v-for="cat in allCategory.filter(
                          (val) => val.game_id == data.game_id
                        )"
                        :key="cat.id"
                      >
                        {{ changeName(cat.category_id) }},
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
                    <v-btn @click="qty++"> + </v-btn>
                  </v-btn-toggle>
                </v-col>
                <v-col cols="12" md="6">
                  <v-btn tile large class="primary" dark>
                    <v-icon>shopping_bag</v-icon>
                    <span>Add To Cart</span>
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
import axios from "axios";
import { exampleMixin } from "../utils/reuseable";
export default {
  mixins: [exampleMixin],
  data() {
    return {
      qty: 0,
    };
  },
  props: ["data"],
  mounted() {
    this.takeCategoryById();
  },
};
</script>

<style>
</style>