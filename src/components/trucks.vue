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
          <th class="tg-c3ow">Vehicle Last Maintenance Mileage</th>
          <th class="tg-c3ow">
            <button class="editButtonClass" v-if="!addTruckToggle" v-on:click="toggle">
              Add Truck
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(Truck, index) in Trucks" :key="index">
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.dotID }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.year }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.type }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.make }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.model }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">
            {{ Truck.miles | formatNumber }}
          </td>
          <td class="tg-e3ua" v-if="index % 2 == 1">{{ Truck.status }}</td>
          <td class="tg-e3ua" v-if="index % 2 == 1">
            {{ Truck.maintenance | formatNumber }}
          </td>
          <td class="tg-e3ua" v-if="index % 2 == 1"><button class="editButtonClass">Edit</button></td>

          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.dotID }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.year }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.type }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.make }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.model }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">
            {{ Truck.miles | formatNumber }}
          </td>
          <td class="tg-7btt" v-if="index % 2 == 0">{{ Truck.status }}</td>
          <td class="tg-7btt" v-if="index % 2 == 0">
            {{ Truck.maintenance | formatNumber }}
          </td>
          <td class="tg-7btt" v-if="index % 2 == 0"><button class="editButtonClass">Edit</button></td>
        </tr>
        <tr v-if="addTruckToggle">
          <td class="tg-e3ua">
            <input
              type="text"
              v-model="truckForm.dotID"
              @keypress="validateNumber"
            />
          </td>
          <td class="tg-e3ua">
            <input
              type="text"
              v-model="truckForm.year"
              @keypress="validateNumber"
            />
          </td>
          <td class="tg-e3ua">
            <select v-model="truckForm.type">
              <option value="Full Sleeper">Full Sleeper</option>
              <option value="Single Cab">Single Cab</option>
              <option value="Single Axle">Single Axle</option>
            </select>
          </td>
          <td class="tg-e3ua">
            <input type="text" v-model="truckForm.make" />
          </td>
          <td class="tg-e3ua">
            <input type="text" v-model="truckForm.model" />
          </td>
          <td class="tg-e3ua">
            <input
              type="text"
              v-model="truckForm.miles"
              @keypress="validateNumber"
            />
          </td>
          <td class="tg-e3ua">
            <select v-model="truckForm.status">
              <option value="In Lot">In Lot</option>
              <option value="On Road">On Road</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </td>
          <td class="tg-e3ua">
            <input
              type="text"
              v-model="truckForm.maintenance"
              @keypress="validateNumber"
            />
          </td>
          <td class="tg-e3ua">
            <button class="editButtonClass" type="submit" v-on:click.prevent="form">Add Truck</button>
            <button class="cancelButtonClass" v-on:click.prevent="toggleClear">Cancel</button>
          </td>
        </tr>
      </tbody>
    </table>
    <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
    </ul>
    </p>
  </div>
</template>

<script>
var numeral = require("numeral");
import store from "@/store/index.js";

export default {
  name: "viewTrucks",
  components: {},
  computed: {
    Trucks: function () {
      return store.state.Trucks;
    },
    errors: function () {
      return store.state.errors;
    },
    addTruckToggle: function () {
      return store.state.addTruckToggle;
    },
  },
  filters: {
    formatNumber: function (value) {
      return numeral(value).format("0,0");
    },
  },
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
};
</script>