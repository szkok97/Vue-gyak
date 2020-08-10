<template>
  <div>
    <h1>Home</h1>
    <form action="">
      <input type="text" v-model="item" />
      <input type="date" v-model="due" @blur="addItem" />
    </form>
    <ul>
      <li
        v-for="item in tasks"
        :key="item.id"
        :class="{ completed: item.completed }"
      >
        <input
          type="checkbox"
          :checked="item.completed"
          @click="changeCompleted(item.id)"
        />
        {{ item.name }}
        <span class="due">{{ item.due }}</span>
        <span :class="{created: item.created}">{{ item.created }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "home",
  components: {
    //html-taget hozunk létre ide mennek az alkomponensek
  },
  data() {
    //statikus adatok változók
    return {
      item: "",
      tasks: [],
      due: new Date(new Date().setDate(new Date().getDate() + 5))
        .toISOString()
        .split("T")[0]
    };
  },

  computed: {
    //dinamikus adatok
  },

  created() {
    //ide tudunk olyan dolgokat berakni, amit a komponens létrehozásakor akarunk mutatni (egyből lefusson)
    axios
      .get(process.env.VUE_APP_API_URL)
      .then(response => {this.tasks = response.data; console.log(this.tasks)})
      .catch(err => console.log(err));
  },

  methods: {
    //onlyan függvények, amit a komponens használata során szeretnénk lefuttatni
    changeCompleted(id) {
      let item = this.tasks.find(item => item.id == id);
      item.completed = !item.completed;
      // szerverrel kommunikáció
      axios
        .put(process.env.VUE_APP_API_URL, item)
        .then(response => console.log(response.data))
        .catch(err => console.log(err));
    },
    addItem() {
      const item = {
        name: this.item,
        due: this.due,
        completed: false
      };
      axios
        .post(process.env.VUE_APP_API_URL, item)
        .then(response => {
          this.tasks.push(response.data);
          this.item = "";
        })
        .catch(err => console.log(err));
    }
  }
};
</script>
<style scoped>
.completed {
  text-decoration: line-through;
  color: #4fc08d;
  border: 0;
}
.completed:hover {
  background: white;
  color: #4fc08d;
}
h1 {
  background: #4fc08d;
  color: white;
  padding: 1rem;
  text-align: center;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  color: #333;
  font-size: 1.5rem;
}
li {
  margin: 1rem;
  position: relative;
  top: 0.5rem;
  border-bottom: 1px solid #4fc08d;
}
li:hover {
  background: #4fc08d;
  color: white;
  transition: 0.5s;
}
form {
  display: flex;
}
input[type="text"] {
  flex-grow: 3;
  font-size: 1.3rem;
  height: 2.5rem;
}
.created {
  font-size: .75rem;
  background: #aaa;
  color: #ffffff;
  padding: .25rem;
}
</style>
