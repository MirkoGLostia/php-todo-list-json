<script>
import axios from 'axios';

export default {
  data() {

    return {
      questList: [],

      newQuest: {
        quest: "",
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
      {{ element.quest }}
      <button type="button" style="background-color: white; color: red; padding: 10px" @click="delteQuest(i)">
        X
      </button>
    </li>
  </ul>

  <form @submit.prevent="onSubmit">
    <label for="quest"> Quest </label>
    <input type="text" name="quest" v-model="newQuest.quest">
    <br />
    <input type="submit" value="ADD TO LIST">
  </form>
</template>

<style></style>
