<template>
  <v-col cols="12" md="6">
    <v-card dark :loading="loading">
      <v-card-text>
        <v-row>
          <v-col cols="12" md="12">
            <v-row>
              <v-col cols="4" md="3" v-for="data in datas" :key="data.id">
                <v-checkbox
                  :label="data.edition"
                  :value="data.id"
                  :disabled="initial.includes(data.id)"
                  v-model="editions"
                >
                </v-checkbox>
              </v-col>
            </v-row>
            <v-spacer></v-spacer>
            <v-btn @click="addingTedition">Adding</v-btn>
          </v-col>
          <v-col cols="12" md="12">
            <v-list>
              <v-virtual-scroll :items="getDatas" height="100" item-height="40">
                <template v-slot:default="{ item }">
                  <v-list-item :key="item.id">
                    <v-list-item-content>
                      <v-list-item-title>
                        {{ getName(item.edition_id) }}
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
      editions: [],
      initial: [],
      datas: [],
      getDatas: [],
    };
  },
  methods: {
    async readEdition() {
      this.loading = true;
      await axios.get("/admin/sub/edition/read").then((resp) => {
        this.datas = resp.data;
        this.loading = false;
      });
    },
    async addingTedition() {
      await axios
        .post("/admin/addgame/restadd/addingEdition", {
          editions: this.editions,
          game_id: this.$route.params.id,
        })
        .then((resp) => {
          this.readingTedition();
          this.voices = [];
          if (resp.data.msg) {
            alert(resp.data.msg);
          }
        });
    },
    async readingTedition() {
      this.loading = true;
      await axios
        .get(`/admin/addgame/restadd/gettingEdition/${this.$route.params.id}`)
        .then((resp) => {
          this.getDatas = resp.data;
          this.loading = false;
          resp.data.map((val) => {
            this.initial.push(val.edition_id);
          });
        });
    },
    getName(id) {
      let data = this.datas.filter((val) => {
        if (val.id == id) {
          return val;
        }
      });
      return data[0].edition;
    },
    async delEdition(id) {
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/admin/addgame/restadd/deleteEdition/${id}`, formData)
        .then((resp) => {
          this.readingTedition();
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
    this.readEdition();
    this.readingTedition();
  },
};
</script>

<style>
</style>