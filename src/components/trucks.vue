<template>
  <div>
    <h3>Truck List</h3>
    <table class="tg">
      <thead>
        <tr>
          <th class="tg-c3ow">Vehicle Dot ID</th>
          <th class="tg-c3ow">Vehicle Year</th>
          <th class="tg-c3ow">Vehicle Type</th>
          <th class="tg-c3ow">Vehicle Make</th>
          <th class="tg-c3ow">Vehicle Model</th>
          <th class="tg-c3ow">Vehicle Current Mileage</th>
          <th class="tg-c3ow">Vehicle Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(Truck, index) in Trucks" :key="index">
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.dotID }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.year }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.type }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.make }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.model }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.miles }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.status }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1"><button>Edit</button></td>

          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.dotID }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.year }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.type }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.make }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.model }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.miles }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.status }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0"><button>Edit</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import store from "@/store/index.js";

export default {
  name: "viewTrucks",
  computed: {
    Trucks: function () {
      return store.state.Trucks;
    },
  },
};
</script>