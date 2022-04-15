<template>
  <v-col cols="12" md="4">
    <div class="white--text">Voice</div>
    <v-form ref="form">
      <v-text-field
        dark
        :rules="voiceError"
        v-model="voice"
        clearable
        placeholder="Enter Voice"
      >
      </v-text-field>
    </v-form>
    <v-btn class="primary" @click="createVoice">Create</v-btn>
    <v-divider></v-divider>
    <v-card :loading="loading">
      <v-card-text>
        <h5>Voice List</h5>
        <v-list>
          <v-virtual-scroll :items="voices" height="200" item-height="40">
            <template v-slot:default="{ item }">
              <v-list-item :key="item.id">
                <v-list-item-content>
                  <v-list-item-title>
                    {{ item.voice }}
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn text @click="delVoice(item.id)">
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
      voice: "",
      voices: [],
      voiceError: [(v) => !!v || "Voice field is required"],
    };
  },
  methods: {
    async createVoice() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        await axios
          .post("/admin/sub/voice/create", {
            voice: this.voice,
          })
          .then((resp) => {
            this.readVoice();
            this.voice = "";
            this.$refs.form.resetValidation();
            this.loading = false;
          });
      }
    },
    async readVoice() {
      this.loading = true;
      await axios.get("/admin/sub/voice/read").then((resp) => {
        this.voices = resp.data;
        this.loading = false;
      });
    },
    async delVoice(id) {
      this.loading = true;
      let formData = new FormData();
      formData.append("_method", "DELETE");
      await axios
        .post(`/admin/sub/voice/delete/${id}`, formData)
        .then((resp) => {
          console.log("Success");
          this.readVoice();
          this.loading = false;
        });
    },
  },
  mounted() {
    this.readVoice();
  },
};
</script>

<style>
</style>