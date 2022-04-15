<template>
  <div>
    <v-toolbar flat dark>
      <v-btn dark @click="$router.back()">
        <v-icon>arrow_back</v-icon>
      </v-btn>
    </v-toolbar>
    <v-container>
      <v-row>
        <v-col cols="12" md="12">
          <v-card dark height="auto" width="auto" :loading="loading">
            <v-card-text>
              <v-row v-for="game in games" :key="game.id">
                <v-col cols="12" md="6">
                  <v-img
                    :src="`/resources/${game.image}`"
                    :alt="game.image"
                    max-height="300"
                    max-width="auto"
                  />
                </v-col>
                <v-col cols="12" md="6">
                  <v-list>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title> Game Name </v-list-item-title>
                        <v-list-item-subtitle>
                          {{ game.name }}
                        </v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title> Publisher </v-list-item-title>
                        <v-list-item-subtitle>
                          {{ game.publisher }}
                        </v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title> Release Date </v-list-item-title>
                        <v-list-item-subtitle>
                          {{ game.release_date }}
                        </v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title> Price </v-list-item-title>
                        <v-list-item-subtitle>
                          {{ game.price }} MMK
                        </v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <total-category></total-category>
        <photo></photo>
        <totalvoice></totalvoice>
        <totaledition></totaledition>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Photo from "./paths/photo.vue";
import TotalCategory from "./paths/totalCategory.vue";
import Totaledition from "./paths/totaledition.vue";
import TotalPlatform from "./paths/totalPlatform.vue";
import Totalvoice from "./paths/totalvoice.vue";
export default {
  data() {
    return {
      games: [],
      loading: false,
    };
  },
  components: {
    TotalPlatform,
    TotalCategory,
    Photo,
    Totalvoice,
    Totaledition,
  },
  methods: {
    async getByGameId() {
      this.loading = true;
      await axios
        .get(`/admin/restadd/getbyid/${this.$route.params.id}`)
        .then((resp) => {
          this.games = resp.data;
          this.loading = false;
        });
    },
  },
  mounted() {
    this.getByGameId();
  },
};
</script>

<style>
</style>
