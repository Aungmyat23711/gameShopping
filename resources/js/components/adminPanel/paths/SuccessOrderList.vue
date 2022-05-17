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
          v-for="data in orderlists.filter((data) => data.status == 'success')"
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
            <!-- <span class="subtitle-2">{{ longTime(data.created_at) }}</span> -->
          </td>
          <td>{{ data.platform }}</td>
          <td>{{ data.user_name }}</td>
          <td>{{ data.qty }}</td>
          <td>{{ data.price }}</td>
          <td>{{ data.payment_method }}</td>
          <td>{{ data.phone }}</td>
          <td>{{ data.address }}</td>
          <td>
            <v-btn disabled class="green white--text"> Done </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </div>
</template>

<script>
export default {
  props: {
    orderlists: {
      required: true,
      type: Array,
    },
  },
};
</script>

<style>
</style>