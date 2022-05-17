<template>
  <v-card dark>
    <v-toolbar flat>
      <v-toolbar-title>
        <h3>Authorization Alert</h3>
      </v-toolbar-title>
    </v-toolbar>
    <v-card-text class="text-center">
      <div class="mt-5">
        <h2 class="white--text">Please Login To Continue!</h2>
        <br />
        <v-btn dark @click="goLogin(dialog)">Login</v-btn>
      </div>
    </v-card-text>
    <v-card-actions class="justify-end">
      <v-btn class="red white--text" @click="dialog.value = false">Close</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    dialog: {
      required: true,
      type: Object,
    },
  },
  methods: {
    goLogin(dialog) {
      dialog.value = false;
      this.$router.push("/user/login");
    },
  },
};
</script>

<style>
</style>