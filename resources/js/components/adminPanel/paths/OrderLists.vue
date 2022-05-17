<template>
  <div>
    <v-simple-table>
      <thead>
        <tr>
          <td colspan="2">Product</td>
          <td>Platform</td>
          <td>User Name</td>
          <td>Qty</td>
          <td>Price</td>
          <td>Payment Method</td>
          <td>Phone</td>
          <td>Address</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="data in orderlists.filter((data) => data.status == 'pending')"
          :key="data.id"
        >
          <td style="width: 150px">
            <v-img
              :src="`/resources/${data.image_item}`"
              width="100"
              height="100"
              class="float-left my-5"
            >
            </v-img>
          </td>
          <td>
            <h6>{{ data.name }}</h6>
            <span class="subtitle-2">{{ longTime(data.created_at) }}</span>
          </td>
          <td>{{ data.platform }}</td>
          <td>{{ data.user_name }}</td>
          <td>{{ data.qty }}</td>
          <td>{{ data.price }}</td>
          <td>{{ data.payment_method }}</td>
          <td>{{ data.phone }}</td>
          <td>{{ data.address }}</td>
          <td>
            <v-btn @click="updateStatus(data.id)"> Approve </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </div>
</template>

<script>
import moment from "moment";
import { eventBus } from "../../../app";
export default {
  props: {
    orderlists: {
      required: true,
      type: Array,
    },
    getPendingOrders: {
      required: true,
      type: Function,
    },
  },
  data() {
    return {};
  },
  methods: {
    longTime(time) {
      return moment(time).fromNow();
    },
    async updateStatus(order_id) {
      let formData = new FormData();
      formData.append("_method", "PUT");
      await axios
        .post(`/admin/order/updateStatus/${order_id}`, formData)
        .then((resp) => {
          this.getPendingOrders();
          eventBus.$emit("approveOrder");
        });
    },
  },
};
</script>

<style>
</style>