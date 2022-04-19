<template>
  <div class="home">
    <Login legend="Authenticate">
      <authHeader />
    </Login>
  </div>
</template>

<script>
// @ is an alias to /src

import Login from "@/components/Login.vue";
import authHeader from "@/components/AuthHeader.vue";

export default {
  name: "LoginView",

  components: {
    Login,
    authHeader,
  },
};
</script>