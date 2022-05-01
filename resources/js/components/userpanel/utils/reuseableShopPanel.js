import { eventBus } from "../../../app";
export const shopPanel = {
    data() {
        return {
            allTotalCategoies: [],
            panel: [0, 1],
            drawer: true,
            allGamesByCatId: [],
            allCount: 0,
            loading: false,
        };
    },
    methods: {
        async getCategoryCount() {
            this.loading = true;
            let platform = this.$route.params.platform.toUpperCase();
            await axios.get(`/user/shop/getCount/${platform}`).then((resp) => {
                this.allTotalCategoies = resp.data;
                this.loading = false;
            });
        },
        getTotalCategory(id) {
            let data = this.allTotalCategoies.filter((val) => {
                if (val.category_id == id) return val;
            });
            return data.length;
        },
        gameController(id, category) {
            let platform = this.$route.params.platform;
            eventBus.$emit("getByCatId", { id, category, platform });
        },
        async getAlldata() {
            let platform = this.$route.params.platform.toUpperCase();
            await axios
                .get(`/user/shop/getAllCount/${platform}`)
                .then((resp) => {
                    this.allCount = resp.data;
                });
        },
        scrollToTop() {
            window.scrollTo(0, 0);
        },

        getAllGames() {
            eventBus.$emit("getAllGames");
        },
        filter() {
            eventBus.$emit("postRange");
        },
    },
};
