<template>
  <div>
    <form v-if="!this.auth">
      <fieldset>
        <legend>{{ legend }}</legend>
        <label>Username: <input type="text" v-model="username" /></label>
        <br />
        <label>Password: <input type="password" v-model="password" /></label>
        <br />
        <button v-on:click.prevent="login()">Login</button>
      </fieldset>
    </form>
    <form v-else>
      <fieldset>
        <button v-on:click="logout()">Logout</button>
      </fieldset>
    </form>
  </div>
</template>

<script>
import store from "@/store/index.js";

export default {
  name: "loginForm",
  props: {
    legend: {
      type: String,
      default: "Login",
    },
  },
  data: function () {
    return {
      username: "",
      password: "",
    };
  },
  computed: {
    auth: function () {
      return store.state.auth;
    },
  },
  methods: {
    login: function () {
      store.state.auth = true;
      store.state.username = this.username;

      this.username = "";
      this.password = "";
    },
    logout: function () {
      store.state.auth = false;
      store.state.username = "";
    },
  },
};
</script>