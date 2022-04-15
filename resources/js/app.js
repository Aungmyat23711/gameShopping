require("./bootstrap");

window.Vue = require("vue").default;
window.Swal = Swal;

import VueRouter from "vue-router";
import Swal from "sweetalert2";
import Vue from "vue";
import Vuetify from "../plugins/vuetify";
import store from "./vuex";
import routes from "./routefolder/gameshoproute";
import VueWaypoint from "vue-waypoint";
import VueLazyload from "vue-lazyload";

//  plugin
export const eventBus = new Vue();
Vue.use(VueWaypoint);
Vue.use(VueRouter);
Vue.use(VueLazyload);

Vue.component(
    "indexsetup-component",
    require("./components/adminPanel/indexsetup").default
);
Vue.component(
    "adminsetup-component",
    require("./components/adminPanel/adminsetup").default
);
Vue.component(
    "usersetup-component",
    require("./components/userpanel/usersetup").default
);
// Vue.component(
//     "animation-component",
//     require("./components/adminPanel/animationComponent").default
// );

const router = new VueRouter({
    mode: "history",
    routes,
});
const app = new Vue({
    el: "#app",
    router,
    vuetify: Vuetify,
    store,
});
