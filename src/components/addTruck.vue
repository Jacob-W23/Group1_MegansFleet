<template>
  <div>
    <form method="post" action="" >
      <fieldset
        v-bind:class="{
          validStyle: truckForm.valid,
          invalidStyle: truckForm.invalid,
        }"
      >
        <legend>New Truck</legend>
        <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
    </ul>
    </p>
        <label
          >DOT ID: <input type="text" v-model="truckForm.dotID" @keypress="validateNumber"
        /></label>
        <label>
          Type:
          <select v-model="truckForm.type" >
            <option value="Full Sleeper">Full Sleeper</option>
            <option value="Single Cab">Single Cab</option>
            <option value="Single Axle">Single Axle</option>
          </select>
        </label>
        <br />
        <br />
        <label
          >Year: <input type="text" v-model="truckForm.year" @keypress="validateNumber"
        /></label>
        <label
          >Make: <input type="text" v-model="truckForm.make" 
        /></label>
        <label
          >Model: <input type="text" v-model="truckForm.model" 
        /></label>
        <label
          >Miles: <input type="text" v-model="truckForm.miles" @keypress="validateNumber"
        /></label>
        <label
          >Last Maintence Mileage:
          <input type="text" v-model="truckForm.maintenance" @keypress="validateNumber"
        /></label>
        <label>
          Status:
          <select v-model="truckForm.status" >
            <option value="In Lot">In Lot</option>
            <option value="On Road">On Road</option>
            <option value="Maintenance">Maintenance</option>
          </select>
        </label>
        <br />
        <br />
        <button type="submit" v-on:click.prevent="form">Add Truck</button>
        <button v-on:click="toggleClear">Cancel</button>
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
        maintenance: "",
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
      this.truckForm.maintenance = "";

      store.state.addTruckToggle = !store.state.addTruckToggle;
    },
    toggle() {
      store.state.addTruckToggle = !store.state.addTruckToggle;
    },
    toggleClear() {
      this.toggle();
      store.state.errors = [];
    },
    form() {
      if (this.checkForm()) {
        this.addTruck();
      }
    },
    checkForm: function () {
      store.state.errors = [];
      if (
        !(
          this.truckForm.dotID == "" ||
          this.truckForm.year == "" ||
          this.truckForm.type == "" ||
          this.truckForm.make == "" ||
          this.truckForm.model == "" ||
          this.truckForm.status == "" ||
          this.truckForm.maintenance == "" ||
          this.truckForm.miles == "" ||
          this.truckForm.year < 1900 ||
          this.truckForm.maintenance < 0 ||
          this.truckForm.miles < 0
        )
      ) {
        return true;
      }

      if (!this.truckForm.dotID) {
        store.state.errors.push("DOT ID required.");
      }
      if (!this.truckForm.year) {
        store.state.errors.push("Year required.");
      } else if (this.truckForm.year < 1900) {
        store.state.errors.push("Year must be greater than 1900.");
      }

      if (!this.truckForm.type) {
        store.state.errors.push("Type required.");
      }
      if (!this.truckForm.make) {
        store.state.errors.push("Make required.");
      }
      if (!this.truckForm.model) {
        store.state.errors.push("Model required.");
      }
      if (!this.truckForm.miles) {
        store.state.errors.push("Miles required.");
      } else if (this.truckForm.miles < 0) {
        store.state.errors.push("Miles must be greater than 0.");
      }
      if (!this.truckForm.status) {
        store.state.errors.push("Status required.");
      }
      if (!this.truckForm.maintenance) {
        store.state.errors.push("Last maintenance Milage required.");
      } else if (this.truckForm.maintenance < 0) {
        store.state.errors.push(
          "Last maintenance Milage must be greater than 0."
        );
      }
      return false;
    },
    validateNumber: (event) => {
      let keyCode = event.keyCode;
      if (keyCode < 48 || keyCode > 57) {
        event.preventDefault();
      }
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
          this.truckForm.maintenance == "" ||
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
    errors: function () {
      return store.state.errors;
    },
  },
};
</script>