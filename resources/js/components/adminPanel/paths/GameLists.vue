<template>
  <div>
    <v-simple-table>
      <thead>
        <tr>
          <td colspan="2">Product</td>
          <td>Platform</td>
          <td>Qty</td>
          <td>Price</td>
          <td>Release Date</td>
          <td>Discount</td>

          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="data in datas" :key="data.id">
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
          <td>{{ data.qty }}</td>
          <td>{{ data.price }} MMK</td>
          <td>{{ data.release_date }}</td>
          <td>{{ data.discount }}%</td>
          <td>
            <v-btn
              class="info white--text"
              :to="`/admin/addgame/restadd/${data.id}`"
            >
              Info
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-simple-table>
  </div>
</template>

<script>
export default {
  props: {
    datas: {
      required: true,
      type: Array,
    },
  },
};
</script>

<style>
</style>