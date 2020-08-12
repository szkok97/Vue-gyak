<template>
  <div class="container">
    <h1>Home</h1>
    <form action="" class="row">
      <input
        type="text"
        v-model="item"
        class="col-sm-7"
        @keyup.enter="addItem"
      />
      <input type="date" v-model="due" class="col-sm-5" />
      <span>{{ item }}</span>
    </form>
    <div class="row">
      <div class="col-sm-12">
        <button class="btn btn-primary col-sm-5 m-1" @click="edit">
          Módosít
        </button>
        <button class="btn btn-primary col-sm-5 m-1" @click="addItem">
          Felvesz
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <i
            class="fas fa-caret-right col-sm-2"
            @click="toogleCompleted"
            style="font-size: 25px;"
          ></i>
          <div class="col-sm-10 text-right">
            <i
              class="fas fa-bell "
              title="nyitott"
              style="font-size: 20px; margin-left: 5px;"
              >{{ nyitott }}</i
            >
            <i
              class="fas fa-calendar "
              title="lejárt"
              style="font-size: 20px; margin-left: 5px;"
              >{{ overdueTask.length }}</i
            >
          </div>
        </div>
      </div>
    </div>
    <ul>
      <task
        @editIconClicked="edit"
        @torles="torles"
        v-for="item in tasks"
        :key="item.id"
        :item="item"
        :showCompleted="showCompleted"
      />
    </ul>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import Task from "@/components/Task.vue";
export default {
  name: "home",
  components: {
    //html-taget hozunk létre ide mennek az alkomponensek
    Task
  },
  data() {
    //statikus adatok változók
    return {
      showCompleted: true,
      item: "",
      due: new Date(new Date().setDate(new Date().getDate() + 5))
        .toISOString()
        .split("T")[0]
    };
  },

  computed: {
    //dinamikus adatok
    ...mapGetters(["overdueTask"]),
    nyitott: function() {
      return this.tasks.filter(item => !item.completed).length;
    },
    tasks: function() {
      return this.$store.state.tasks;
    }
  },

  created() {
    //ide tudunk olyan dolgokat berakni, amit a komponens létrehozásakor akarunk mutatni (egyből lefusson)
  },

  methods: {
    //onlyan függvények, amit a komponens használata során szeretnénk lefuttatni

    addItem() {
      const item = {
        name: this.item,
        due: this.due,
        completed: false
      };
      if (item.name != "") {
        axios
          .post(process.env.VUE_APP_API_URL, item)
          .then(response => {
            this.tasks.push(response.data);
            this.item = "";
          })
          .catch(err => console.log(err));
      }
    },
    edit(item) {
      this.item = item.name;
      this.due = item.due;
      console.log(item);
      axios
        .put(process.env.VUE_APP_API_URL, {data: item})
        //.then(response => console.log(response))
        .catch(err => console.log(err));
    },
    toogleCompleted() {
      this.showCompleted = !this.showCompleted;
    },
    torles(item) {
      //this.tasks.splice(this.tasks.indexOf(item.id), 1);
      console.log(item);
      axios
        .delete(process.env.VUE_APP_API_URL, { data: item })
        .then(response => {
          this.tasks.splice(this.tasks.indexOf(response.id), 1);
        })
        .catch(err => console.log(err));
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
  margin-top: 0;
  margin-bottom: 5px;
  margin-right: 0;
  margin-left: 0;
}

h1 {
  background: #4fc08d;
  color: white;
  padding: 1rem;
  text-align: center;
}
form {
  display: flex;
}

.created {
  font-size: 0.75rem;
  background: #aaa;
  color: #ffffff;
  padding: 0.25rem;
}
</style>
