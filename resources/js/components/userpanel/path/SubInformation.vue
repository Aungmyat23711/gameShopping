<template>
  <div>
    <v-tabs dark v-model="model">
      <v-tab>Description</v-tab>
      <v-tab>Additional Information</v-tab>
      <v-tab>Reviews</v-tab>
    </v-tabs>
    <v-tabs-items v-model="model" dark>
      <v-tab-item>
        <v-container>
          <p class="grey--text">{{ datas.description }}</p>
        </v-container>
      </v-tab-item>
      <v-tab-item>
        <v-container>
          <v-row>
            <v-col cols="12" md="12">
              <v-simple-table class="black darken-2">
                <tbody>
                  <tr>
                    <td>Game Mode</td>
                    <td>{{ datas.game_mode }}</td>
                  </tr>
                </tbody>
              </v-simple-table>
            </v-col>
          </v-row>
        </v-container>
      </v-tab-item>
      <v-tab-item>
        <v-card
          v-scroll.self="onScroll"
          class="overflow-y-auto"
          max-height="200"
          flat
        >
          <v-row>
            <v-col
              cols="12"
              sm="12"
              md="12"
              v-for="data in dummy"
              :key="data.name"
            >
              <v-card class="blue-grey darken-2">
                <v-card-text>
                  <v-row>
                    <v-col cols="12" sm="8" md="8">
                      <div class="white--text">
                        <div class="d-flex">
                          <v-avatar color="primary" size="50">
                            <span>{{ getTwo(data.name) }}</span>
                          </v-avatar>
                          <div class="ml-5 mt-1">
                            <h5>{{ data.name }}</h5>
                            <span class="subtitle-2">{{ data.date }}</span>
                          </div>
                        </div>
                        <br />
                        <p>
                          {{ data.review }}
                        </p>
                      </div>
                    </v-col>
                    <v-col cols="12" sm="4" md="4">
                      <span>Rating {{ data.rating }}</span>
                    </v-col>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-card>
        <div class="mt-10">
          <v-card>
            <v-card-text>
              <v-row>
                <v-col cols="12" md="12" sm="12">
                  <h3>Add a review</h3>
                  <br />
                  <v-textarea
                    filled
                    label="Your Review*"
                    rows="4"
                    v-model="review"
                  >
                  </v-textarea>
                </v-col>
                <v-col cols="12" md="6" sm="6">
                  <v-text-field filled label="Name" v-model="name">
                  </v-text-field>
                </v-col>
                <v-col cols="12" md="6" sm="6">
                  <v-text-field filled label="Email" v-model="email">
                  </v-text-field>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn @click="addReview">Send Review</v-btn>
            </v-card-actions>
          </v-card>
        </div>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
export default {
  data() {
    return {
      model: null,
      scrollInvoked: 0,
      review: "",
      name: "",
      email: "",
      dummy: [
        {
          name: "Aung Myint Myat",
          review: "Nice Game",
          rating: 5,
          date: "April 12,2022",
        },
        {
          name: "Aung Myint Naing",
          review: "Great Game",
          rating: 4.5,
          date: "April 13,2022",
        },
        {
          name: "Kyaw Myint Naing",
          review: "Not Bad",
          rating: 4.5,
          date: "April 13,2022",
        },
      ],
    };
  },
  props: ["datas"],
  methods: {
    onScroll() {
      this.scrollInvoked++;
    },
    getTwo(name) {
      return name
        .split(" ")
        .map((data) => data[0])
        .join("");
    },
    addReview() {
      this.dummy = [
        {
          name: this.name,
          email: this.email,
          review: this.review,
          date: "June 12,2022",
          rating: 4,
        },
        ...this.dummy,
      ];
    },
  },
};
</script>

<style>
</style>