import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import adminModule from "./modules/adminData";
import userModule from "./modules/userData";
Vue.use(Vuex);
const store = new Vuex.Store({
    modules: {
        adminModule,
        userModule,
    },
    plugins: [
        createPersistedState({
            key: ["admin"],
            path: adminModule.adminData,
            storage: {
                getItem: (key) => localStorage.getItem(key),
                setItem: (key, value) => localStorage.setItem(key, value),
                removeItem: (key) => localStorage.removeItem(key),
            },
        }),
        createPersistedState({
            key: ["user"],
            path: userModule.userData,
            storage: {
                getItem: (key) => localStorage.getItem(key),
                setItem: (key, value) => localStorage.setItem(key, value),
                removeItem: (key) => localStorage.removeItem(key),
            },
        }),
    ],
});
export default store;
