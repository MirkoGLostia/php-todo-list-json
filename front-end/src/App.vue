<script>
import axios from 'axios';

export default {
  data() {

    return {
      questList: [],

      newQuest: {
        quest: "",
        status: "not done"
      }
    };
  },
  methods: {

    onSubmit() {

      const url = 'http://localhost/php-todo-list-json/php/newQuest.php';
      const data = this.newQuest;
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post(url, data, headers)
        .then(res => {

          const data = res.data;
          this.questList = data;

          this.newQuest.quest = "";
        })
    },

    delteQuest(index) {

      const url = 'http://localhost/php-todo-list-json/php/deleteQuest.php';
      const data = { "index": index };
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post(url, data, headers)
        .then(res => {

          const data = res.data;
          this.questList = data;
        });

    },

    questDone(index) {

      const url = 'http://localhost/php-todo-list-json/php/questDone.php';
      const data = { "index": index };
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post(url, data, headers)
        .then(res => {

          const data = res.data;
          this.questList = data;
        });

    }

  },
  mounted() {

    axios.get("http://localhost/php-todo-list-json/php/questList.php")
      .then(res => {

        const data = res.data;
        this.questList = data;
      });
  }
}

</script>

<template>
  <h1>Quest list</h1>

  <ul>
    <li v-for="(element, i) in questList" :key="i">
      <span :class="element.status === 'not done' ? '' : 'done'" @click="questDone(i)">{{ element.quest
      }}</span>
      <button type="button" style="background-color: white; color: red; padding: 10px" @click="delteQuest(i)">
        X
      </button>
    </li>
  </ul>

  <form @submit.prevent="onSubmit">
    <label for="quest"> Quest </label>
    <input type="text" name="quest" v-model="newQuest.quest">
    <br />
    <button type="submit"> To do </button>
  </form>
</template>

<style lang="scss">
.done {
  text-decoration: line-through;
}
</style>
