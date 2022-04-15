<template>
  <div>
    <header id="nav">
      <v-app-bar dark class="nav-bar pt-3" fixed flat>
        <v-avatar size="60" class="gameIcon d-none d-sm-flex">
          <img src="/resources/gameicon.png" alt="gameicon" />
        </v-avatar>
        <v-spacer></v-spacer>
        <div class="nav-bar d-none d-sm-flex">
          <ul class="nav-list">
            <li
              :class="li.title"
              v-for="li in navLink"
              :key="li.title"
              @click="goNav(li.title)"
            >
              {{ li.title }}
            </li>
          </ul>
        </div>
        <div class="mobile d-flex d-sm-none">
          <v-row class="mb-3" v-if="ismobile == false">
            <v-btn text @click="openNav">
              <v-icon color="white" size="50">menu</v-icon>
            </v-btn>
          </v-row>
          <ul class="mobile-nav-list hidden">
            <li
              class="d-block pa-2"
              :class="li.title"
              v-for="li in navLink"
              :key="li.title"
              @click="goNav(li.title)"
            >
              {{ li.title }}
            </li>
            <li>
              <v-btn text @click="closeNav">
                <v-icon color="red">clear</v-icon>
              </v-btn>
            </li>
          </ul>
        </div>
        <!-- <v-spacer></v-spacer> -->
      </v-app-bar>
      <transition appear @before-enter="beforeEnter" @enter="enter">
        <div class="hero-text-box-frame">
          <div class="hero-text-box">
            <h1>
              All games in one place<br />
              Enjoy shopping!
            </h1>
          </div>
        </div>
      </transition>
    </header>
  </div>
</template>

<script>
import { eventBus } from "../../app";
import gsap from "gsap";
// import { defineComponent } from "vue";

export default {
  data() {
    return {
      navLink: [
        { title: "Home" },
        { title: "Shop" },
        { title: "Goty" },
        { title: "About" },
      ],
      ismobile: false,
      link: localStorage.getItem("activeNav"),
    };
  },

  methods: {
    goNav(title) {
      if (title != "Home") {
        eventBus.$emit(`${title}`);
      }
      if (title === "Home") {
        document.querySelector("#nav").scrollIntoView({ behavior: "smooth" });
      }
    },
    beforeEnter(el) {
      el.style.opacity = 0;
      el.style.transform = "scale(0,0)";
    },
    enter(el, done) {
      gsap.to(el, {
        duration: 1,
        opacity: 1,
        scale: 1,
        ease: "bounce.out",
        onComplete: done,
      });
    },
    openNav() {
      document.querySelector(".mobile-nav-list").classList.remove("hidden");
      this.ismobile = true;
    },
    closeNav() {
      document.querySelector(".mobile-nav-list").classList.add("hidden");
      this.ismobile = false;
    },
  },
  mounted() {
    const home = document.querySelectorAll(".Home");
    console.log(home);
    const shop = document.querySelectorAll(".Shop");
    const goty = document.querySelectorAll(".Goty");
    for (let i = 0; i < 2; i++) {
      home[i].classList.add("active");
      goty[i].classList.remove("active");
      shop[i].classList.remove("active");

      eventBus.$on("shopActive", () => {
        home[i].classList.remove("active");
        goty[i].classList.remove("active");
        shop[i].classList.add("active");
      });
      eventBus.$on("gotyActive", () => {
        shop[i].classList.remove("active");
        goty[i].classList.add("active");
        home[i].classList.remove("active");
      });
      eventBus.$on("homeActive", () => {
        goty[i].classList.remove("active");
        shop[i].classList.remove("active");
        home[i].classList.add("active");
      });
    }
  },
};
</script>

<style scoped>
/* navbar */
.nav-bar {
  height: 90px !important;
}
.nav-bar ul {
  list-style: none;
}
.nav-bar li {
  display: inline-block;
  margin: 0 20px;
  padding: 5px 15px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  text-align: center;
  letter-spacing: 1px;
}
.nav-bar li:hover,
.nav-bar li:active {
  background: rgba(141, 140, 140, 0.13);
}

.nav-bar li a {
  text-decoration: none;
}
.gameIcon img {
  height: 70px;
  width: auto;
}
.gameIcon {
  float: left;
  padding: 20px;
  width: 50px;
}
.nav-list {
  float: right;
  padding: 20px;
  margin: 0;
  justify-content: center;
  align-items: center;
  display: flex;
}
header .hero-text-box-frame {
  background-image: -webkit-gradient(
      linear,
      left top,
      left bottom,
      from(rgba(0, 0, 0, 0.7)),
      to(rgba(0, 0, 0, 0.7))
    ),
    url("/resources/wallpaper2.jpg");
  height: 100vh;
  background-size: cover;
  background-position: center;
  position: relative;
  background-attachment: fixed;
}
.hero-text-box {
  display: flex;
  justify-content: center;
  align-items: center;

  /* From https://css.glass */
  background: rgba(255, 255, 255, 0.18);
  border-radius: 0px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(6.3px);
  -webkit-backdrop-filter: blur(6.3px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  width: 600px;
  height: 300px;
}
.hero-text-box-frame {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}
h1 {
  color: #fff;
  font-weight: 300;
  text-transform: uppercase;
  word-spacing: 2px;
  letter-spacing: 1px;
}
.active {
  background: rgba(9, 131, 231, 0.637);
}
.mobile {
  width: 100%;
  height: 100%;
  justify-content: center;
  align-items: center;
}
.mobile-nav-list {
  background: rgba(255, 255, 255, 0.18);
  border-radius: 0px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(6.3px);
  -webkit-backdrop-filter: blur(6.3px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  padding: 0;
  margin-top: 160px;
  width: 100%;
  list-style: none;
  text-align: center;
  cursor: pointer;
}
.mobile-nav-list li {
  width: 100%;
  color: white;
  margin: 0 auto;
}
.hidden {
  display: none;
}
</style>