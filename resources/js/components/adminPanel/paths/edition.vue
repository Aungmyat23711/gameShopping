<template>
  <v-col cols="12" md="4">
    <div class="white--text">Editions</div>
    <v-form ref="form">
      <v-text-field
        dark
        :rules="editionError"
        v-model="edition"
        placeholder="Enter Editions"
      >
      </v-text-field>
    </v-form>
    <v-btn class="primary" @click="createEdition">Create</v-btn>
    <v-divider></v-divider>
    <v-card :loading="loading">
      <v-card-text>
        <h5>Edition List</h5>
        <v-list>
          <v-virtual-scroll :items="editions" height="200" item-height="40">
            <template v-slot:default="{ item }">
              <v-list-item :key="item.id">
                <v-list-item-content>
                  <v-list-item-title>
                    {{ item.edition }}
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn text @click="delEdition(item.id)">
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
      edition: "",
      editions: [],
      editionError: [(v) => !!v || "Edition field is required"],
    };
  },
  methods: {
    async createEdition() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        await axios
          .post("/admin/sub/edition/create", {
            edition: this.edition,
          })
          .then((resp) => {
            this.readEdition();
            this.edition = "";
            this.$refs.form.resetValidation();
            this.loading = false;
          });
      }
    },
    async readEdition() {
      this.loading = true;
      await axios.get("/admin/sub/edition/read").then((resp) => {
        this.editions = resp.data;
        this.loading = false;
      });
    },
    async delEdition(id) {
      this.loading = true;
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/admin/sub/edition/delete/${id}`, formData)
        .then((resp) => {
          console.log("Success");
          this.readEdition();
          this.loading = false;
        });
    },
  },
  mounted() {
    this.readEdition();
  },
};
</script>

<style>
</style>