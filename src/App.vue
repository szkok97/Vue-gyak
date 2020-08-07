<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <router-view />
  </div>
</template>
<script>
</script>
<style scpoed>
#nav{
  text-align: center;
  padding-top: 20px;
}
#nav a{
  color: black;
  padding: 10px;
  font-size: 25px;
}
</style>
