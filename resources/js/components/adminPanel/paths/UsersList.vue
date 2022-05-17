<template>
  <div>
    <v-simple-table>
      <thead>
        <tr>
          <td>User Id</td>
          <td>Name</td>
          <td>Email</td>
          <td>Register At</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="data in users" :key="data.id">
          <td>{{ data.id }}</td>
          <td>{{ data.name }}</td>
          <td>{{ data.email }}</td>
          <td>{{ longTime(data.created_at) }}</td>
        </tr>
      </tbody>
    </v-simple-table>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: {
    users: {
      required: true,
      type: Array,
    },
  },
  methods: {
    longTime(time) {
      return moment(time).fromNow();
    },
  },
};
</script>

<style>
</style>