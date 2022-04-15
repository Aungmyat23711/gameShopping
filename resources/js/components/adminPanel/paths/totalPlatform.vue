<template>
  <v-col cols="12" md="6">
    <v-card dark :loading="loading">
      <v-card-text>
        <v-row>
          <v-col cols="12" md="12">
            <v-row>
              <v-col cols="4" md="3" v-for="data in datas" :key="data.id">
                <v-checkbox
                  :label="data.platform"
                  :value="data.id"
                  :disabled="initial.includes(data.id)"
                  v-model="platforms"
                >
                </v-checkbox>
              </v-col>
            </v-row>
            <!-- <v-radio
               
              >
              </v-radio> -->

            <v-spacer></v-spacer>
            <v-btn @click="addingTplatform">Adding</v-btn>
          </v-col>
          <v-col cols="12" md="12">
            <v-list>
              <v-virtual-scroll :items="getDatas" height="100" item-height="40">
                <template v-slot:default="{ item }">
                  <v-list-item :key="item.id">
                    <v-list-item-content>
                      <v-list-item-title>
                        {{ getName(item.platform_id) }}
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
      headers: [
        { text: "Game Id", value: "game_id" },
        { text: "Platform", value: "platform" },
        { text: "Actions", value: "action", sortable: false },
      ],
      datas: {},
      loading: false,
      platforms: [],
      initial: [],
      datas: [],
      getDatas: [],
    };
  },
  methods: {
    async readPlatform() {
      this.loading = true;
      await axios.get("/admin/sub/read").then((resp) => {
        this.datas = resp.data;
        this.loading = false;
      });
    },
    async addingTplatform() {
      await axios
        .post("/admin/addgame/restadd/addingPlatform", {
          platforms: this.platforms,
          game_id: this.$route.params.id,
        })
        .then((resp) => {
          this.readingTplatform();
          this.platforms = [];
          if (resp.data.msg) {
            alert(resp.data.msg);
          }
        });
    },
    async readingTplatform() {
      this.loading = true;
      await axios
        .get(`/admin/addgame/restadd/gettingPlatform/${this.$route.params.id}`)
        .then((resp) => {
          this.getDatas = resp.data;
          this.loading = false;
          resp.data.map((val) => {
            this.initial.push(val.platform_id);
          });
        });
    },
    getName(id) {
      let data = this.datas.filter((val) => {
        if (val.id == id) {
          return val;
        }
      });
      return data[0].platform;
    },
    async delPlatform(id) {
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/admin/addgame/restadd/deletePlatform/${id}`, formData)
        .then((resp) => {
          this.readingTplatform();
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
    this.readPlatform();
    this.readingTplatform();
  },
};
</script>

<style>
</style>