const state = {
    rangeData: [0, 150000],
};
export default {
    state,
    getters: {
        rangeData: (state) => {
            return state.rangeData;
        },
    },
    actions: {
        setRangeData({ commit }, rangeData) {
            commit("getRangeData", rangeData);
        },
    },
    mutations: {
        getRangeData(state, rangeData) {
            state.rangeData = rangeData;
        },
    },
};
