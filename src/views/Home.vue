<template>
  <div>
    <h1>Home</h1>
    <ul>
      <li v-for="item in tasks" :key="item.id" :class="{completed: item.completed}">
        <input type="checkbox" :checked=item.completed @click="changeCompleted(item.id)">
        {{item.name}} : {{item.due}}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'
export default{
  name: 'home',
  components: { //html-taget hozunk létre ide mennek az alkomponensek

  },
  data(){   //statikus adatok változók
    return {
      tasks: [],
    }
  },

  computed: {   //dinamikus adatok

  },

  created() {   //ide tudunk olyan dolgokat berakni, amit a komponens létrehozásakor akarunk mutatni (egyből lefusson)
    axios.get('http://localhost/vue/task-manager/api/index.php')
      .then(response => console.log(response))
      .catch(err =>console.log(err))
  },

  methods: {    //onlyan függvények, amit a komponens használata során szeretnénk lefuttatni
    changeCompleted(id) {
      let item = this.tasks.find(item => item.id == id);
      item.completed = !item.completed;
    }
  }
}
</script>
<style scoped>
.completed{
  text-decoration: line-through;
  color: #4fc08d;
  border: 0;
}
.completed:hover{
  background: white;
  color: #4fc08d;
}
h1{
  background: #4fc08d;
  color: white;
  padding: 1rem;
  text-align: center;
}
ul{
  list-style-type: none;
  margin: 0;
  padding: 0;
  color: #333;
  font-size: 1.5rem;
}
li{
  margin: 1rem;
  position: relative;
  top: 0.5rem;
  border-bottom: 1px solid #4fc08d;
}
li:hover{
  background: #4fc08d;
  color: white;
  transition: 0.5s;
}
</style>
