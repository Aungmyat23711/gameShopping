export const exampleMixin = {
    data() {
        return {
            allCategory: [],
        };
    },
    methods: {
        async takeCategoryByGameId(id) {
            await axios.get(`/user/index/getCategory/${id}`).then((resp) => {
                this.allCategory = resp.data;
            });
        },
    },
};
