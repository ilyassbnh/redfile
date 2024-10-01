<template>
    <div>
      <h2>Register</h2>
      <form @submit.prevent="handleRegister">
        <div>
          <label for="name">Name:</label>
          <input type="text" v-model="name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" v-model="password" required />
        </div>
        <div>
          <label for="password_confirmation">Confirm Password:</label>
          <input type="password" v-model="password_confirmation" required />
        </div>
        <button type="submit">Register</button>
        <p>Already have an account? <router-link to="/login">Login here</router-link>.</p>
      </form>
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        errorMessage: '',
      };
    },
    methods: {
      async handleRegister() {
        try {
          const response = await axios.post('/api/register', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          });
          alert('Registration successful!');
          this.$router.push('/login');
        } catch (error) {
          this.errorMessage = error.response.data.message || 'Registration failed. Please try again.';
        }
      },
    },
  };
  </script>
  
  <style>
  .error {
    color: red;
  }
  </style>
  