<template>
  <v-col cols="12" md="12">
    <v-row>
      <v-card dark>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="4">
              <v-card>
                <v-card-text>
                  <vue-upload-multiple-image
                    @upload-success="uploadImageSuccess"
                    @before-remove="beforeRemove"
                    :showEdit="false"
                    :showDelete="false"
                    :data-images="images"
                    browseText="Browse Images"
                    dragText="Drag and drop here"
                    dropText="Release here"
                    primaryText="status"
                    popupText="You can insert multiple image"
                  ></vue-upload-multiple-image>
                </v-card-text>
                <v-card-actions>
                  <!-- <v-btn @click="addingPhotos">Adding</v-btn> -->
                </v-card-actions>
              </v-card>
            </v-col>
            <v-col cols="12" md="8">
              <v-row>
                <v-col cols="6" md="4" v-for="data in datas" :key="data.id">
                  <v-hover v-slot="{ hover }">
                    <v-img
                      class="grey darken-4"
                      :src="`/resources/${$route.params.id}/${data.photo}`"
                      :aspect-ratio="16 / 9"
                    >
                      <v-expand-transition>
                        <div
                          class="
                            d-flex
                            transition-fast-in-fast-out
                            darken-2
                            v-card--reveal
                            text-h2
                            white--text
                            justify-center
                          "
                          v-if="hover"
                          style="height: 100%"
                        >
                          <v-btn
                            class="red white--text mt-10"
                            @click="deletePhoto(data)"
                            >Delete</v-btn
                          >
                        </div>
                      </v-expand-transition>
                    </v-img>
                  </v-hover>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-row>
  </v-col>
</template>

<script>
import axios from "axios";
import VueUploadMultipleImage from "vue-upload-multiple-image";
export default {
  components: {
    VueUploadMultipleImage,
  },
  data() {
    return {
      images: [],
      input: [],
      datas: [],
    };
  },
  methods: {
    async uploadImageSuccess(formData, index, fileList) {
      this.images = [];
      await axios
        .post(
          `/admin/addgame/restadd/addphotos/${this.$route.params.id}/${index}`,
          formData
        )
        .then((resp) => {
          this.getPhotoById();
          const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            color: "#fff",
            background: "#3fc04d",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            iconColor: "#fff",
          });
          Toast.fire({
            title: "Successfully Inserted",
            icon: "success",
          });
        });
    },
    beforeRemove(index, done, fileList) {
      console.log("index", index, fileList);
      var r = confirm("remove image");
      if (r == true) {
        done();
      } else {
      }
    },
    async getPhotoById() {
      await axios
        .get(`/admin/addgame/restadd/getPhotoById/${this.$route.params.id}`)
        .then((resp) => {
          this.datas = resp.data;
          this.datas.map((val, i) => {
            this.images.push({
              path: `/resources/${this.$route.params.id}/${val.photo}`,
              default: 1,
              highlight: i,
            });
          });
        });
    },
    async deletePhoto(data) {
      this.images = [];
      let formData = new FormData();
      formData.append("current", data.photo);
      formData.append("_method", "DELETE");
      confirm("Are you sure want to delete") &&
        (await axios
          .post(
            `/admin/addgame/restadd/deletePhoto/${data.id}/${this.$route.params.id}`,
            formData
          )
          .then((resp) => {
            this.getPhotoById();
          }));
    },
  },

  mounted() {
    this.getPhotoById();
  },
};
</script>

<style>
</style>