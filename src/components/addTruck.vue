<template>
  <div>
    <form method="post" action="">
      <fieldset
        v-bind:class="{
          validStyle: truckForm.valid,
          invalidStyle: truckForm.invalid,
        }"
      >
        <legend>New Truck</legend>
        <label>DOT ID: <input type="text" v-model="truckForm.dotID" /></label>
        <label>
          Type:
          <select v-model="truckForm.type">
            <option value="Full Sleeper">Full Sleeper</option>
            <option value="Single Cab">Single Cab</option>
            <option value="Single Axle">Single Axle</option>
          </select>
        </label>
        <br />
        <br />
        <label>Year: <input type="text" v-model="truckForm.year" /></label>
        <label>Make: <input type="text" v-model="truckForm.make" /></label>
        <label>Model: <input type="text" v-model="truckForm.model" /></label>
        <label>Miles: <input type="text" v-model="truckForm.miles" /></label>
        <label>
          Status:
          <select v-model="truckForm.status">
            <option value="In Lot">In Lot</option>
            <option value="On Road">On Road</option>
            <option value="Maintenance">Maintenance</option>
          </select>
        </label>
        <br />
        <br />
        <button type="submit" v-on:click.prevent="addTruck">Add Truck</button>
        <button v-on:click="toggle">Cancel</button>
      </fieldset>
    </form>
  </div>
</template>

<script>
import store from "@/store/index.js";

export default {
  name: "addTruck",
  data: function () {
    return {
      truckForm: {
        id: null,
        dotID: "",
        year: "",
        type: "",
        make: "",
        model: "",
        miles: "",
        status: "",
        valid: false,
        invalid: true,
      },
    };
  },
  methods: {
    addTruck: function () {
      this.truckForm.id = store.state.Trucks.length + 1;
      store.commit("addTruck", this.truckForm);

      this.truckForm.id = null;
      this.truckForm.dotID = "";
      this.truckForm.year = "";
      this.truckForm.type = "";
      this.truckForm.make = "";
      this.truckForm.model = "";
      this.truckForm.miles = "";
      this.truckForm.status = "";

      store.state.addTruckToggle = !store.state.addTruckToggle;
    },
    toggle() {
      store.state.addTruckToggle = !store.state.addTruckToggle;
    },
  },
  watch: {
    truckForm: {
      handler: function () {
        if (
          this.truckForm.dotID == "" ||
          this.truckForm.year == "" ||
          this.truckForm.type == "" ||
          this.truckForm.make == "" ||
          this.truckForm.model == "" ||
          this.truckForm.status == "" ||
          this.truckForm.miles == ""
        ) {
          this.truckForm.valid = false;
          this.truckForm.invalid = true;
        } else {
          this.truckForm.valid = true;
          this.truckForm.invalid = false;
        }
      },
      deep: true,
    },
  },
  computed: {
    Trucks: function () {
      return store.state.Trucks;
    },
  },
};
</script>