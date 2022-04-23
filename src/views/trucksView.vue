<template>
  <div class="home">
    <viewTrucks />
  </div>
</template>

<script>
// @ is an alias to /src

import viewTrucks from "@/components/trucks.vue";
import store from "@/store/index.js";

export default {
  name: "trucksView",

  components: {
    viewTrucks,
  },
  computed: {},
  methods: {
    toggle() {
      store.state.addTruckToggle = !store.state.addTruckToggle;
    },
  },
};
</script>