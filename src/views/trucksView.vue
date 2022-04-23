<template>
  <div class="home">
    <button v-if="!addTruckToggle" v-on:click="toggle">Add Truck</button>
    <addTruck v-if="addTruckToggle" />
    <viewTrucks />
  </div>
</template>

<script>
// @ is an alias to /src
import addTruck from "@/components/addTruck.vue";
import viewTrucks from "@/components/trucks.vue";
import store from "@/store/index.js";

export default {
  name: "trucksView",

  components: {
    viewTrucks,
    addTruck,
  },
  computed: {
    addTruckToggle: function () {
      return store.state.addTruckToggle;
    },
  },
  methods: {
    toggle() {
      store.state.addTruckToggle = !store.state.addTruckToggle;
    },
  },
};
</script>