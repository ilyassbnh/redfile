<template>
    <div>
        <h2>Chatbot</h2>
        <div v-for="message in messages" :key="message.id">{{ message.text }}</div>
        <input v-model="userInput" @keyup.enter="sendMessage" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            userInput: ''
        }
    },
    methods: {
        sendMessage() {
            this.messages.push({ id: this.messages.length, text: this.userInput });
            // Add logic to get a response from the bot
            this.userInput = '';
        }
    }
}
</script>
