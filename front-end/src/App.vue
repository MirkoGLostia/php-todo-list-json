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

  },
  mounted() {

    axios.get("http://localhost/php-todo-list-json/php/questList.php")
      .then(res => {

        console.log("ciao");
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
