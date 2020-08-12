<template>
  <div>
    <li
      v-show="!item.completed || (showCompleted && item.completed)"
      :class="{ completed: item.completed }"
    >
      <div>
        <input
          type="checkbox"
          :checked="item.completed"
          @click="changeCompleted"
        />
        {{ item.name }}
        <router-link :to="'tasks/' + item.id"
          ><i class="fas fa-eye sm-1 font"></i
        ></router-link>
        <div class="font">
          <a href="#"
            ><i
              style="margin-right: 10px"
              class="fas fa-trash sm-1"
              @click="torles(item.id)"
            ></i>
          </a>
          <a href="#"
            ><i
              @click="edit()"
              style="margin-right: 10px"
              class="fas fa-pen sm-1 "
            ></i
          ></a>
        </div>
      </div>
      <div>
        <span class="due">{{ item.due }}</span>
        <span class="font" :class="{ created: item.created }">{{
          item.created
        }}</span>
      </div>
    </li>
  </div>
</template>

<script>
import axios from "axios";

export default {
  //props: ['item']
  props: {
    showCompleted: { type: Boolean },
    item: {
      type: Object, // [String, Array]
      default: function() {
        return { id: 0 };
      },
      required: true
    }
  },
  methods: {
    changeCompleted() {
      this.item.completed = !this.item.completed;
      // szerverrel kommunikáció
      axios
        .put(process.env.VUE_APP_API_URL, this.item)
        .then(response => console.log(response.data))
        .catch(err => console.log(err));
    },
    edit() {
      //this.item = this.item.name
      //this.due = this.item.due
      // TODO due
      this.$emit("editIconClicked", this.item);
    },
    torles() {
      this.$emit("torles", this.item);
    }
  }
};
</script>

<style>
.font {
  float: right;
  font-size: 0.85rem;
  margin-top: 5px;
}
li {
  list-style-type: none;
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
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  color: #333;
  font-size: 1.5rem;
}
input[type="text"] {
  flex-grow: 3;
  font-size: 1.3rem;
  height: 2.5rem;
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
</style>
