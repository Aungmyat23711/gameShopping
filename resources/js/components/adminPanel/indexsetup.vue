<template>
  <div>
    <v-app>
      <index-header></index-header>
      <v-main>
        <indexcontent></indexcontent>
      </v-main>
      <v-footer class="footer" dark>
        <index-footer />
      </v-footer>
    </v-app>
  </div>
</template>

<script>
import Indexcontent from "./indexcontent.vue";
import indexHeader from "./indexheader.vue";

import IndexFooter from "./indexFooter.vue";
export default {
  components: { indexHeader, Indexcontent, IndexFooter },
  data() {
    return {
      isOpen: false,
      text: "Hello World",
    };
  },

  methods: {
    toggleModal() {
      this.isOpen = !this.isOpen;
    },
    alertBox(data) {
      alert(data);
    },
    mouseOver(data) {
      alert(data);
    },
  },
};
</script>

<style>
#app {
  margin: 0;
  padding: 0;
  font-size: 20px;
  box-sizing: border-box;
  background: #fff;
  text-rendering: optimizeLegibility;
  font-family: "Lato", "Arial", sans-serif;
}
.row {
  max-width: 1140px;
  margin: 0 auto;
}

.fade-enter {
  opacity: 0;
}
.fade-enter-active {
  transition: opacity 0.5s ease-out;
}
section {
  padding: 80px 0;
}
</style>