import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    auth: false,
    username: "",
    cache: [],
    editTruckIndex: "",
    Trucks: [
      {
        id: "1",
        dotID: "0759894",
        year: "2016",
        type: "Full Sleeper",
        make: "Freightliner",
        model: "Cascadia 125 6x4",
        miles: "305000",
        status: "On Road",
        maintenance: "300000"
      },
      {
        id: "2",
        dotID: "0113024",
        year: "2001",
        type: "Single Cab",
        make: "Freightliner",
        model: "FL70",
        miles: "436000",
        status: "Maintenance",
        maintenance: "430000"
      },
      {
        id: "3",
        dotID: "726051",
        year: "2012",
        type: "Single Axle",
        make: "Chevrolet",
        model: "Chevrolet Silverado HD 5500",
        miles: "234000",
        status: "In Lot",
        maintenance: "230000"
      },
    ],
    errors: [],
    addTruckToggle: false,
    editTruckToggle: false,
  },
  getters: {
  },
  mutations: {
    addTruck: function (state, payload) {
      state.Trucks.push(Object.assign({}, payload));
    },
  },
  actions: {
  },
  modules: {
  }
})
