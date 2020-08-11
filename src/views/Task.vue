<template>
  <div>
    <ul>
      <task :item="item" :showCompleted="true" />
    </ul>
  </div>
</template>
<script>
import Task from "@/components/Task.vue";
export default {
  //this.$route.params.id
  components: {
    Task
  },
  data() {
    return {
      item: this.$store.state.tasks.find(
        item => item.id == this.$route.params.id
      )
    };
  }
};
</script>
<style scoped></style>
