<template>
  <div id="app">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
      crossorigin="anonymous"
    />
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/stats">Stats</router-link> |
      <router-link to="/login" v-if="!loggedIn">Login</router-link>
      <router-link to="/logout" v-if="loggedIn">Logout</router-link>
    </div>
    <router-view />
  </div>
</template>
<script>
export default {
  name: "App",
  data() {
    return {
      loggedIn: false
    };
  },
  created() {
    this.$store.dispatch("getTasks");
  }
};
</script>
<style>
#app {
  font-family: sans-serif;
}
#nav {
  text-align: center;
  padding-top: 20px;
}
#nav a {
  color: black;
  padding: 10px;
  font-size: 25px;
}
</style>
