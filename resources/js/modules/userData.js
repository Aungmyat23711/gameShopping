const state = {
    userData: null,
};
export default {
    state,
    getters: {
        userData: (state) => {
            return state.userData;
        },
    },
    actions: {
        setUserData({ commit }, userData) {
            commit("getUserData", userData);
        },
    },
    mutations: {
        getUserData(state, userData) {
            state.userData = userData;
        },
    },
};
