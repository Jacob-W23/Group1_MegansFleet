<template>
  <div id="app">
    <nav>
      <router-link to="/">Home</router-link>
      <router-link to="/login">Login</router-link>
      <router-link to="/Trucks" v-if="auth">Trucks</router-link>
      <router-link to="/Maintenance" v-if="auth"
        >Maintenance Reports</router-link
      >
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
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
  padding: 8px;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
