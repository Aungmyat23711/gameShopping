<template>
  <v-col cols="12" md="4">
    <div class="white--text">Platform</div>
    <v-form ref="form">
      <v-text-field
        dark
        clearable
        placeholder="Enter Platform"
        v-model="platform"
        required
        :rules="platFormError"
      >
      </v-text-field>
    </v-form>
    <v-btn class="primary" @click="createPlatform">Create</v-btn>
    <v-divider></v-divider>
    <v-card :loading="loading">
      <v-card-text>
        <h5>Platform List</h5>
        <v-list>
          <v-virtual-scroll :items="platforms" height="200" item-height="40">
            <template v-slot:default="{ item }">
              <v-list-item :key="item.id">
                <v-list-item-content>
                  <v-list-item-title>
                    {{ item.platform }}
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn text @click="delPlatform(item.id)">
                    <v-icon color="#ff0000">clear</v-icon>
                  </v-btn>
                </v-list-item-action>
              </v-list-item>
            </template>
          </v-virtual-scroll>
        </v-list>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      platform: "",
      platforms: [],
      platFormError: [(v) => !!v || "Platform field is required"],
    };
  },
  methods: {
    async createPlatform() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        await axios
          .post("/admin/sub/create", {
            platform: this.platform,
          })
          .then((resp) => {
            this.readPlatform();
            this.platform = "";
            this.$refs.form.resetValidation();
            this.loading = false;
          });
      }
    },
    async readPlatform() {
      this.loading = true;
      await axios.get("/admin/sub/read").then((resp) => {
        this.platforms = resp.data;
        this.loading = false;
      });
    },
    async delPlatform(id) {
      this.loading = true;
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios.post(`/admin/sub/delete/${id}`, formData).then((resp) => {
        console.log("Success");
        this.readPlatform();
        this.loading = false;
      });
    },
  },
  mounted() {
    this.readPlatform();
  },
};
</script>

<style>
</style>