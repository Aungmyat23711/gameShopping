<template>
  <v-col cols="12" md="4">
    <div class="white--text">Category</div>
    <v-form ref="form">
      <v-text-field
        dark
        :rules="categoryError"
        v-model="category"
        placeholder="Enter Category"
      >
      </v-text-field>
    </v-form>
    <v-btn class="primary" @click="createCategory">Create</v-btn>
    <v-divider></v-divider>
    <v-card :loading="loading">
      <v-card-text>
        <h5>Category List</h5>
        <v-list>
          <v-virtual-scroll :items="categories" height="200" item-height="40">
            <template v-slot:default="{ item }">
              <v-list-item :key="item.id">
                <v-list-item-content>
                  <v-list-item-title>
                    {{ item.category }}
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn text @click="delCategory(item.id)">
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
      category: "",
      categories: [],
      categoryError: [(v) => !!v || "Category field is required"],
    };
  },
  methods: {
    async createCategory() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        await axios
          .post("/admin/sub/category/create", {
            category: this.category,
          })
          .then((resp) => {
            this.readCategory();
            this.category = "";
            this.$refs.form.resetValidation();
            this.loading = false;
          });
      }
    },
    async readCategory() {
      this.loading = true;
      await axios.get("/admin/sub/category/read").then((resp) => {
        this.categories = resp.data;
        this.loading = false;
      });
    },
    async delCategory(id) {
      this.loading = true;
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/admin/sub/category/delete/${id}`, formData)
        .then((resp) => {
          console.log("Success");
          this.readCategory();
          this.loading = false;
        });
    },
  },
  mounted() {
    this.readCategory();
  },
};
</script>

<style>
</style>