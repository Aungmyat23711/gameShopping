<template>
  <v-col cols="12" md="6">
    <v-card dark :loading="loading">
      <v-card-text>
        <v-row>
          <v-col cols="12" md="12">
            <v-row>
              <v-col cols="4" md="3" v-for="data in datas" :key="data.id">
                <v-checkbox
                  :label="data.category"
                  :value="data.id"
                  :disabled="initial.includes(data.id)"
                  v-model="categories"
                >
                </v-checkbox>
              </v-col>
            </v-row>
            <v-spacer></v-spacer>
            <v-btn @click="addingTcategory">Adding</v-btn>
          </v-col>
          <v-col cols="12" md="12">
            <v-list>
              <v-virtual-scroll :items="getDatas" height="100" item-height="40">
                <template v-slot:default="{ item }">
                  <v-list-item :key="item.id">
                    <v-list-item-content>
                      <v-list-item-title>
                        {{ getName(item.category_id) }}
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
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
export default {
  data() {
    return {
      datas: [],
      loading: false,
      categories: [],
      initial: [],
      datas: [],
      getDatas: [],
    };
  },
  methods: {
    async readCategory() {
      this.loading = true;
      await axios.get("/admin/sub/category/read").then((resp) => {
        this.datas = resp.data;
        this.loading = false;
      });
    },
    async addingTcategory() {
      await axios
        .post("/admin/addgame/restadd/addingCategory", {
          categories: this.categories,
          game_id: this.$route.params.id,
        })
        .then((resp) => {
          this.readingTcategory();
          this.categories = [];
          if (resp.data.msg) {
            alert(resp.data.msg);
          }
        });
    },
    async readingTcategory() {
      this.loading = true;
      await axios
        .get(`/admin/addgame/restadd/gettingCategory/${this.$route.params.id}`)
        .then((resp) => {
          this.getDatas = resp.data;
          this.loading = false;
          resp.data.map((val) => {
            this.initial.push(val.category_id);
          });
        });
    },
    getName(id) {
      let data = this.datas.filter((val) => {
        if (val.id == id) {
          return val;
        }
      });
      return data[0].category;
    },
    async delCategory(id) {
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/admin/addgame/restadd/deleteCategory/${id}`, formData)
        .then((resp) => {
          this.readingTcategory();
          let Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            color: "#fff",
            background: "#3fc04d",
            iconColor: "#fff",
            timer: 1500,
            timerProgressBar: true,
            showConfirmButton: false,
          });
          Toast.fire({
            title: "Successfully Deleted",
            icon: "success",
          });
        });
    },
  },
  mounted() {
    this.readCategory();
    this.readingTcategory();
  },
};
</script>

<style>
</style>