<template>
  <div>
    <section id="home"></section>
    <section
      class="content"
      id="shop"
      v-waypoint="{
        active: condition,
        callback: onWaypoint,
        options: intersectionOptions,
      }"
    >
      <div class="content-center">
        <h1>Choose Your Game Console</h1>
      </div>
      <div>
        <v-row class="modalBox">
          <v-col
            v-for="data in showBoxDatas"
            :key="data.title"
            wrap
            cols="12"
            md="4"
            :class="`${data.back} showBox`"
            @mouseover="activeClass(data.title)"
            @mouseleave="deactiveClass"
          >
            <span :class="`${data.textColor}--text showBoxText`">{{
              data.title
            }}</span>
            <div
              v-if="active == data.title"
              :class="{ 'expand-box': active == data.title }"
            >
              <v-btn :class="`${data.back}`">
                <span :class="`${data.textColor}--text`" @click="alertBox"
                  >Shop</span
                >
              </v-btn>
            </div>
          </v-col>
          <v-col cols="12" class="mt-5" align="center">
            <v-btn>See All</v-btn>
          </v-col>
        </v-row>
      </div>
    </section>
    <section
      class="gameoftheyear"
      id="goty"
      v-waypoint="{
        active: condition1,
        callback: onWaypoint2,
        options: intersectionOptions,
      }"
    >
      <div class="content-center">
        <h1>Game Of The Year Editions</h1>
      </div>
      <div class="gotyBox">
        <v-row class="justify-center">
          <v-col
            cols="auto"
            md="2"
            sm="3"
            v-for="(img, index) in images"
            :key="index"
            class="gotyImg"
          >
            <div style="width: 150px; height: 220px">
              <img
                class="gotyimage"
                :src="`/resources/${img.name}`"
                :alt="`/resource/${img.alt}`"
              />
            </div>
          </v-col>
          <v-col cols="12" class="text-center mt-3">
            <v-btn class="primary" dark>See More</v-btn>
          </v-col>
        </v-row>
      </div>
    </section>
  </div>
</template> 

<script>
import { eventBus } from "./../../app";
import gsap from "gsap";
import waypoint from "vue-waypoint";
export default {
  data() {
    return {
      isOpen: false,
      active: "",
      condition: true,
      condition1: true,
      number: 0,
      tweenedNumber: 0,
      intersectionOptions: {
        root: null,
        rootMargin: "0px 0px 0px 0px",
        threshold: [0.25, 0.75], // [0.25, 0.75] if you want a 25% offset!
      },
      showBoxDatas: [
        { back: "blue darken-4", textColor: "white", title: "PS4" },
        { back: "grey lighten-5", textColor: "black", title: "PS5" },
        { back: "indigo darken-1", textColor: "white", title: "PC" },
        {
          back: "green darken-3",
          textColor: "white",
          title: "XBOX ONE",
        },
        {
          back: "green lighten-1",
          textColor: "black",
          title: "XBOX S",
        },
        {
          back: "red darken-4",
          textColor: "white",
          title: "NINTENDO",
        },
      ],
      images: [
        { name: "darksoul.jpg", alt: "darksoul" },
        { name: "dragonage.jpg", alt: "dragon" },
        { name: "godofwar.jpg", alt: "godofwar" },
        { name: "gta5.png", alt: "gta5" },
        { name: "hades.jpg", alt: "hades" },
        { name: "horizon.jpg", alt: "horizon" },
        { name: "overwatch1.jpg", alt: "overwatch" },
        { name: "sekio.jpg", alt: "sekio" },
        { name: "taketwo.png", alt: "taketwo" },
        { name: "tlou.png", alt: "tlou" },
        { name: "witcher.jpg", alt: "witcher" },
        { name: "zelda.jpg", alt: "zelda" },
      ],
    };
  },

  methods: {
    activeClass(title) {
      this.active = title;
    },
    deactiveClass() {
      this.active = "";
    },
    alertBox() {
      $(".white--text").removeClass();
    },
    toggleBox() {
      this.isOpen = !this.isOpen;
    },
    // ScrollValue() {},
    onWaypoint({ going, direction }) {
      if (direction === this.$waypointMap.DIRECTION_TOP) {
        if (going === this.$waypointMap.GOING_IN) {
          gsap.from(".showBox", {
            duration: 1,
            opacity: 0,
            scale: 0,
            y: 200,
            ease: "power1",
            stagger: {
              ease: 0.1,
              from: "edges",
            },
          });

          this.condition = false;
        }
      }
    },
    onWaypoint2({ going, direction }) {
      if (direction === this.$waypointMap.DIRECTION_TOP) {
        if (going === this.$waypointMap.GOING_IN) {
          gsap.from(".gotyImg", {
            duration: 1,
            opacity: 0,
            scale: 0,
            y: 100,
            ease: "power1",
            stagger: {
              each: 0.1,
              from: "start",
            },
          });

          this.condition1 = false;
        }
      }
    },
  },
  mounted() {
    let sections = document.querySelectorAll("section");

    window.addEventListener("scroll", () => {
      let current = "";
      sections.forEach((section) => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop) {
          current = section.getAttribute("id");
        }
      });

      if (current === "shop") {
        eventBus.$emit("shopActive");
      } else if (current === "goty") {
        eventBus.$emit("gotyActive");
      } else {
        eventBus.$emit("homeActive");
      }
    });
    eventBus.$on("Shop", () => {
      // document.querySelector("#shop").scrollIntoView({ behavior: "smooth" });
      var element = document.getElementById("shop");
      var headerOffset = 90;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    });
    eventBus.$on("Goty", () => {
      var element = document.getElementById("goty");
      var headerOffset = 45;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    });
  },
};
</script>

<style scoped>
.content-center {
  display: flex;
  align-items: center;
  justify-content: center;
}
.content {
  background: rgb(233, 230, 230);
}
.showBox {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 200px;
  position: relative;
}
.showBoxText {
  font-size: 150%;
  letter-spacing: 1px;
  word-spacing: 2px;
}
.expand-box {
  /* From https://css.glass */
  background: rgba(0, 0, 0, 0.52);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(6.5px);
  -webkit-backdrop-filter: blur(6.5px);
  width: 100%;
  height: 100%;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
}
h1 {
  color: rgb(128, 128, 128);
  padding-bottom: 30px;
  text-align: center;
  word-spacing: 2px;
  letter-spacing: 1px;
}
h1:after {
  content: " ";
  display: block;
  width: 150px;
  height: 2px;
  margin: 0 auto;
  background-color: blue;
  margin-top: 30px;
}
.toggleModal {
  max-width: 500px;
  display: flex;
  justify-content: center;
  align-items: center;
}
/* .animated {
  max-width: 500px;
} */
/* .gameoftheyear {
  height: 100vh;
} */
.gotyBox {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: auto;
}
.bar {
  background: grey;
}
.fade-enter {
  opacity: 0;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s ease-out;
}
.fade-leave-to {
  opacity: 0;
}
.gotyImg img {
  border: 2px solid grey;
  border-radius: 12px;
  transform: scale(1);
  transition: transform 0.5s;
}
.gotyImg img:hover {
  border: 2px solid rgb(3, 212, 3);
  border-radius: 12px;
  transform: scale(0.9);
}
.gameoftheyear {
  background: midnightblue;
  background-size: cover;
}
#home {
  background: rgb(233, 230, 230);
}
.gotyimage {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>