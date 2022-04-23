<template>
  <div id="app">
    <header>
      <img
        src="@/assets/MegansFleet_Yellow.png"
        alt="Megans Fleets Logo"
        height="300"
        width="450"
        class="logo"
      />
    </header>

    <nav>
      <ul>
        <li><router-link to="/" class="active">Home</router-link></li>
        <li><router-link to="/login">Login</router-link></li>
        <li><router-link to="/Trucks" v-if="auth">Trucks</router-link></li>
        <li>
          <router-link to="/Maintenance" v-if="auth"
            >Maintenance Reports</router-link
          >
        </li>
        <li><a href="#about">About</a></li>
      </ul>
    </nav>
    <router-view />
  </div>
</template>


<script>
import store from "@/store/index.js";
export default {
  name: "mainView",

  components: {},
  computed: {
    auth: function () {
      return store.state.auth;
    },
  },
};
</script>

<style>
.validStyle {
  background-color: lightgreen;
  border: 1px solid white;
}

.invalidStyle {
  background-color: salmon;
  border: 1px solid white;
}

.logo {
  display: block;
  margin-left: auto;
  margin-right: auto;
  position: sticky;
  top: 0;
}

body {
  background-color: rgba(252, 252, 252, 0.884);
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  position: sticky;
  top: 0;
}

li {
  float: left;
  font-size: 25px;
  font-family: sans-serif;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #ecdd00;
  color: black;
  font-weight: bold;
}

h2 {
  text-align: center;
  font-family: sans-serif;
}

h3 {
  text-align: center;
  font-family: sans-serif;
}

p {
  text-align: center;
  font-family: sans-serif;
}

hr.line {
  border: 1px solid black;
}

.tg {
  border-collapse: collapse;
  border-spacing: 0;
  margin-left: auto;
  margin-right: auto;
}
.tg td {
  border-color: black;
  border-style: double;
  border-width: 3px;
  font-family: sans-serif;
  font-size: 14px;
  overflow: hidden;
  padding: 20px 10px;
  word-break: normal;
}
.tg th {
  background-color: #333;
  border-color: black;
  border-style: double;
  border-width: 3px;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: normal;
  color: white;
  overflow: hidden;
  padding: 10px 5px;
  word-break: normal;
  font-weight: bold;
}
.tg .tg-e3ua {
  background-color: rgb(207, 207, 207);
  border-color: inherit;
  text-align: center;
  vertical-align: top;
}

.tg .tg-7btt {
  border-color: inherit;
  background-color: white;
  text-align: center;
  vertical-align: top;
}

legend {
  font-weight: bold;
}
</style>
