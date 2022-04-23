<template>
  <div class="home">
    <viewTrucks />
    <button v-if="!addTruckToggle" v-on:click="toggle">Add Truck</button>
    <addTruck v-if="addTruckToggle" />
  </div>
</template>

<script>
// @ is an alias to /src
import addTruck from "@/components/addTruck.vue";
import viewTrucks from "@/components/trucks.vue";
import store from "@/store/index.js";

export default {
  name: "addTruckView",

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