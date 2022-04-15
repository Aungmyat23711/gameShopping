<template>
  <div>
    <div style="height: 30px"></div>
    <v-toolbar flat ref="top" dark>
      <v-toolbar-title
        class="ml-15 white--text"
        style="font-weight: bolder; letterspace: 1px"
      >
        Adding Games
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="goAdding" class="mr-3" v-if="isUpdate"> Adding </v-btn>
      <div class="mt-8">
        <v-text-field solo append-icon="search" v-model="search">
        </v-text-field>
      </div>
    </v-toolbar>
    <v-container>
      <v-row>
        <v-col cols="12" md="12">
          <v-row>
            <v-card>
              <v-card-text>
                <v-data-table
                  :headers="headers"
                  :items="datas"
                  :search="search"
                  sort-by="name"
                  class="elevation-1"
                  :loading="loading"
                  loading-text="Loading...Please Wait"
                >
                  <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                      edit
                    </v-icon>
                    <v-icon small @click="deleteItem(item.id)"> delete </v-icon>
                    <v-btn
                      text
                      class="ml-1"
                      :to="`/admin/addgame/restadd/${item.id}`"
                    >
                      <v-icon>input</v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card-text>
            </v-card>
          </v-row>
        </v-col>
        <v-col cols="12" md="12">
          <v-form ref="form">
            <v-card>
              <v-card-text>
                <v-row>
                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Name</v-subheader>
                    <v-text-field
                      solo
                      v-model="form.name"
                      clearable
                      :rules="validate.nameError"
                    />
                  </v-col>
                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Release Date</v-subheader>
                    <v-text-field
                      solo
                      v-model="form.release"
                      clearable
                      :rules="validate.releaseError"
                    />
                  </v-col>
                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Publisher</v-subheader>
                    <v-text-field
                      solo
                      v-model="form.publisher"
                      clearable
                      :rules="validate.publisherError"
                    />
                  </v-col>

                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Developer</v-subheader>
                    <v-text-field
                      solo
                      v-model="form.developer"
                      clearable
                      :rules="validate.developerError"
                    />
                  </v-col>
                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Rated</v-subheader>
                    <v-text-field
                      solo
                      v-model="form.rated"
                      clearable
                      :rules="validate.ratedError"
                    />
                  </v-col>
                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Game Mode</v-subheader>
                    <v-text-field
                      solo
                      v-model="form.game_mode"
                      clearable
                      :rules="validate.gameModeError"
                    />
                  </v-col>

                  <v-col cols="12" md="4" class="pt-0 mt-0">
                    <v-subheader>Price</v-subheader>
                    <v-text-field
                      type="number"
                      solo
                      v-model="form.price"
                      clearable
                      :rules="validate.priceError"
                    />
                  </v-col>
                  <v-col cols="6" md="4" class="pt-0 mt-0">
                    <v-subheader>Quantity</v-subheader>
                    <v-text-field
                      type="number"
                      solo
                      v-model="form.qty"
                      clearable
                      :rules="validate.qtyError"
                    />
                  </v-col>
                  <v-col cols="6" md="4" class="pt-0 mt-0">
                    <v-subheader>Discount</v-subheader>
                    <v-text-field
                      type="number"
                      solo
                      v-model="form.discount"
                      clearable
                      :rules="validate.discountError"
                    />
                  </v-col>
                  <v-col cols="6" md="4" class="pt-0 mt-0">
                    <v-subheader>Platform</v-subheader>
                    <v-select
                      :items="platforms"
                      solo
                      v-model="form.platform"
                      clearable
                      :rules="validate.platformError"
                    ></v-select>
                  </v-col>
                  <v-col cols="12" md="6" class="pt-0 mt-0">
                    <v-btn class="mb-5" @click="uploadFile">
                      <span>Poster</span>
                    </v-btn>
                    <v-file-input
                      @change="changeImage"
                      id="file"
                      style="display: none"
                      v-model="form.file"
                    />
                    <v-sheet elevation="3" height="auto" width="auto">
                      <img
                        width="auto"
                        height="300"
                        class="poster"
                        :src="image ? `/resources/${image}` : ''"
                        alt="poster"
                        id="image"
                      />
                    </v-sheet>
                  </v-col>
                  <v-col cols="12" md="6" class="pt-0 mt-0">
                    <v-btn class="mb-5" @click="uploadFileItem">
                      <span>Image</span>
                    </v-btn>
                    <v-file-input
                      @change="changeImageItem"
                      id="fileItem"
                      style="display: none"
                      v-model="form.fileItem"
                    />
                    <v-sheet elevation="3" height="auto" width="auto">
                      <img
                        width="200"
                        height="300"
                        alt="image"
                        id="imageItem"
                        :src="imageItem ? `/resources/${imageItem}` : ''"
                      />
                    </v-sheet>
                  </v-col>
                  <v-col cols="12" md="12" class="pt-0 mt-0">
                    <v-subheader>Description</v-subheader>
                    <v-textarea
                      solo
                      v-model="form.description"
                      :rules="validate.description"
                    >
                    </v-textarea>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-card-actions class="justify-end">
                <v-btn @click="isUpdate ? updateGame() : insertGame()">{{
                  isUpdate ? "Update" : "Insert"
                }}</v-btn>
              </v-card-actions>
            </v-card>
          </v-form>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      loading: false,
      images: [],
      headers: [
        { text: "Game", value: "name" },
        { text: "Release", value: "release_date" },
        { text: "Publisher", value: "publisher" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      datas: [],
      image: "",
      imageItem: "",
      platforms: [],
      isUpdate: false,
      form: {
        name: "",
        developer: "",
        game_mode: "",
        rated: "",
        release: "",
        publisher: "",
        price: "",
        qty: "",
        discount: "",
        platform: "",
        file: [],
        fileItem: [],
        description: "",
        gameId: "",
      },
      validate: {
        nameError: [(v) => !!v || "Name field is required"],
        releaseError: [(v) => !!v || "Release Date field is required"],
        publisherError: [(v) => !!v || "Publisher field is required"],
        priceError: [(v) => !!v || "Price field is required"],
        qtyError: [(v) => !!v || "Quantity field is required"],
        descriptionError: [(v) => !!v || "Description field is required"],
        developerError: [(v) => !!v || "Developer field is required"],
        ratedError: [(v) => !!v || "Rated field is required"],
        gameModeError: [(v) => !!v || "Game Mode field is required"],
        discountError: [
          (v) => v <= 100 || "Discount is less than or equal 100",
        ],
        platformError: [(v) => !!v || "Platform field is required"],
      },
    };
  },
  methods: {
    uploadFile() {
      document.getElementById("file").click();
    },
    uploadFileItem() {
      document.getElementById("fileItem").click();
    },
    changeImage() {
      let input = this.form.file;
      let reader = new FileReader();
      reader.onload = () => {
        let result = reader.result;
        let img = document.getElementById("image");
        img.src = result;
      };
      reader.readAsDataURL(input);
    },
    changeImageItem() {
      let input = this.form.fileItem;
      let reader = new FileReader();
      reader.onload = () => {
        let result = reader.result;
        let img = document.getElementById("imageItem");
        img.src = result;
      };
      reader.readAsDataURL(input);
    },
    async insertGame() {
      this.loading = true;
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("release_date", this.form.release);
      formData.append("publisher", this.form.publisher);
      formData.append("developer", this.form.developer);
      formData.append("rated", this.form.rated);
      formData.append("game_mode", this.form.game_mode);
      formData.append("price", this.form.price);
      formData.append("qty", this.form.qty);
      formData.append("discount", this.form.discount);
      formData.append("platform", this.form.platform);
      formData.append("image", this.form.file);
      formData.append("image_item", this.form.fileItem);
      formData.append("description", this.form.description);
      if (this.$refs.form.validate()) {
        await axios.post("/admin/insertgame", formData).then((resp) => {
          this.readGames();
          this.goAdding();
          this.scrollTop("top");
          this.loading = false;
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
      }
    },
    async updateGame() {
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("release_date", this.form.release);
      formData.append("publisher", this.form.publisher);
      formData.append("developer", this.form.developer);
      formData.append("rated", this.form.rated);
      formData.append("game_mode", this.form.game_mode);
      formData.append("price", this.form.price);
      formData.append("qty", this.form.qty);
      formData.append("discount", this.form.discount);
      formData.append("image", this.form.file);
      formData.append("image_item", this.form.fileItem);
      formData.append("description", this.form.description);
      formData.append("platform", this.form.platform);
      formData.append("current", this.image);
      formData.append("current_item", this.imageItem);
      formData.append("_method", "PUT");
      await axios
        .post(`/admin/updategame/${this.gameId}`, formData)
        .then((resp) => {
          this.goAdding();
          this.readGames();
          this.scrollTop("top");
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
    scrollTop(refName) {
      var element = this.$refs[refName];
      var top = element.offsetTop;
      window.scrollTo(0, top);
    },
    async readGames() {
      this.loading = true;
      await axios.get("/admin/readgame").then((resp) => {
        this.datas = resp.data;
        this.loading = false;
      });
    },
    goAdding() {
      this.isUpdate = false;
      this.form.name = "";
      this.form.release = "";
      this.form.publisher = "";
      this.form.developer = "";
      this.form.rated = "";
      this.form.game_mode = "";
      this.form.price = "";
      this.form.qty = "";
      this.form.discount = "";
      document.getElementById("image").src = "";
      document.getElementById("imageItem").src = "";
      this.$refs.form.resetValidation();
      this.form.description = "";
      this.form.file = [];
      this.form.fileItem = [];
    },
    editItem(item) {
      this.isUpdate = true;
      this.form.name = item.name;
      this.form.release = item.release_date;
      this.form.publisher = item.publisher;
      this.form.developer = item.developer;
      this.form.rated = item.rated;
      this.form.game_mode = item.game_mode;
      this.form.price = item.price;
      this.form.qty = item.qty;
      this.form.discount = item.discount;
      this.form.platform = item.platform;
      this.image = item.image;
      this.imageItem = item.image_item;
      this.form.description = item.description;
      this.gameId = item.id;
    },
    async deleteItem(id) {
      this.loading = true;
      let formData = new FormData();
      formData.append("_method", "DELETE");
      confirm("Are you sure want to delete") &&
        (await axios
          .post(`/admin/addgame/deleteItem/${id}`, formData)
          .then((resp) => {
            this.loading = false;
            this.readGames();
          }));
    },
    async readPlatform() {
      await axios.get("/admin/sub/read").then((resp) => {
        let alldatas = resp.data;
        for (let i = 0; i < alldatas.length; i++) {
          this.platforms.push(alldatas[i].platform);
        }
      });
    },
  },
  mounted() {
    this.readGames();
    this.readPlatform();
  },
};
</script>

<style>
@media only screen and (max-width: 768px) {
  .poster {
    width: 350px;
    height: 220px;
  }
}
</style>