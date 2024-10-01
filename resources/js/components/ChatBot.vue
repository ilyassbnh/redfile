<template>
    <div>
      <div v-for="message in messages" :key="message.id">{{ message.text }}</div>
      <input v-model="userInput" @keyup.enter="sendMessage" />
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        messages: [],
        userInput: '',
      };
    },
    methods: {
      sendMessage() {
        const input = this.userInput;
        this.messages.push({ id: Date.now(), text: `User: ${input}` });
        this.getResponse(input);
        this.userInput = '';
      },
      async getResponse(input) {
        // API call logic will go here
        const response = await this.fetchHotelData(input);
        this.messages.push({ id: Date.now(), text: `Bot: ${response}` });
      },
      async fetchHotelData(query) {
        // Replace with your API call
        // Example:
        const res = await fetch(`http://localhost:8000/api/hotel/search?query=${query}`);
        const data = await res.json();
        return data; // Format the response as needed
      },
    },
  };
  </script>
  