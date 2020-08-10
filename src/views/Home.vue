<template>
  <div class="container">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
      crossorigin="anonymous"
    />
    <h1>Home</h1>
    <form action="" class="row">
      <input type="text" v-model="item" class="col-sm-7" />
      <input type="date" v-model="due" @blur="addItem" class="col-sm-5" />
    </form>
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <i
            class="fas fa-caret-right col-sm-2"
            @click="toogleCompleted"
            style="font-size: 25px;"
          ></i>
          <div class="col-sm-10 text-right">
          <i class="fas fa-bell " title="nyitott" style="font-size: 20px; margin-left: 5px;"
            >{{nyitott}}</i
          >
          <i class="fas fa-calendar " title="lejárt" style="font-size: 20px; margin-left: 5px;"
            >{{lejart}}</i
          >
          </div>
        </div>
      </div>
    </div>
    <ul>
      <li
        v-show="!item.completed || (showCompleted && item.completed)"
        v-for="item in tasks"
        :key="item.id"
        :class="{ completed: item.completed }"
      >
        <div>
          <input
            type="checkbox"
            :checked="item.completed"
            @click="changeCompleted(item.id)"
          />
          {{ item.name }}
          <div class="font">
            <a href="#"
              ><i style="margin-right: 10px" class="fas fa-trash sm-1"></i
            ></a>
            <a href="#"><i class="fas fa-pen sm-1 "></i></a>
          </div>
        </div>
        <div>
          <span class="due">{{ item.due }}</span>
          <span class="font" :class="{ created: item.created }">{{
            item.created
          }}</span>
        </div>
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
      showCompleted: true,
      item: "",
      tasks: [],
      due: new Date(new Date().setDate(new Date().getDate() + 5))
        .toISOString()
        .split("T")[0]
    };
  },

  computed: {
    //dinamikus adatok
    nyitott: function(){
      return this.tasks.filter(item => !item.completed).length
    },
    lejart: function(){
      return this.tasks.filter(item => !item.completed && item.due < new Date().toISOString()).length
    },
  },

  created() {
    //ide tudunk olyan dolgokat berakni, amit a komponens létrehozásakor akarunk mutatni (egyből lefusson)
    axios
      .get(process.env.VUE_APP_API_URL)
      .then(response => {
        this.tasks = response.data;
        console.log(this.tasks);
      })
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
    },
    toogleCompleted() {
      this.showCompleted = !this.showCompleted;
    }
  }
};
</script>
<style scoped>
.font {
  float: right;
  font-size: 0.85rem;
  margin-top: 5px;
}
form {
  padding: 0;
  margin: 0;
}
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
  font-size: 0.75rem;
  background: #aaa;
  color: #ffffff;
  padding: 0.25rem;
}
</style>
