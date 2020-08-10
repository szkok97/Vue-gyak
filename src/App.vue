<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/login" v-if="loggedIn">Login</router-link>
      <router-link to="/logout" v-else>Logout</router-link>
    </div>
    <router-view />
  </div>
</template>
<script>
export default {
  data() {
    return {
      loggedIn: false
    };
  }
};
</script>
<style>
#app{
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
