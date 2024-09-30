<template>
    <div class="login-container">
      <h1>Login</h1>
      <form @submit.prevent="handleLogin">
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" v-model="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
      <div v-if="error" class="error">{{ error }}</div>
      <router-link to="/register">Don't have an account? Register here</router-link>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: '',
        error: ''
      };
    },
    methods: {
      async handleLogin() {
        try {
          // Make an API call to your Laravel backend for authentication
          const response = await this.$http.post('/api/login', {
            email: this.email,
            password: this.password
          });
          
          // Handle successful login (e.g., redirect or store token)
          console.log('Login successful:', response.data);
          // Redirect to another page or save token
        } catch (err) {
          this.error = 'Login failed. Please check your credentials.';
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .login-container {
    max-width: 300px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .error {
    color: red;
  }
  </style>
  