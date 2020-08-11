<template>
  <div>
    <h1>Stats</h1>
    <!--<p>{{ tasks }}</p>-->
    <div class="row justify-content-center m-5">
      <div class="col-sm-5 m-2 w1">
        <h2>Összes</h2>
        <i class="fas fa-file"> {{ $store.state.tasks.length }}</i>
      </div>
      <div class="col-sm-5 m-2 w2">
        <h2>Kész</h2>
        <i class="fas fa-file">
          {{ $store.state.tasks.filter(item => item.completed).length }}</i
        >
      </div>
      <div class="col-sm-5 m-2 w3">
        <h2>Nyitva</h2>
        <i class="fas fa-file">
          {{ $store.state.tasks.filter(item => !item.completed).length }}</i
        >
      </div>
      <div class="col-sm-5 m-2 w4">
        <h2>Lejárt</h2>
        <i class="fas fa-file"> {{ overdueTask.length }}</i>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  name: "Stats",
  computed: mapGetters(["overdueTask"])
};
</script>
<style>
h1 {
  background-color: #4fc08d;
  color: white;
  padding: 1rem;
  text-align: center;
}
div.row div.col-sm-5 {
  color: #fff;
}
.w1 {
  background: #5a3bb3;
}
.w2 {
  background: #0192a5;
}
.w3 {
  background: #cd4c26;
}
.w4 {
  background: #ea8906;
}
</style>
