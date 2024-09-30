<template>
  <div class="login-container">
    <h1>Sign In</h1>
    <form @submit.prevent="handleLogin">
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit" :disabled="loading">{{ loading ? 'Signing in...' : 'Sign In' }}</button>
    </form>
    <div v-if="error" class="error">{{ error }}</div>
    <router-link to="/register">Don't have an account? Register here</router-link>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: '',
      loading: false
    };
  },
  methods: {
    async handleLogin() {
      this.error = ''; // Clear any previous error
      this.loading = true; // Indicate loading state

      try {
        // Make an API call to your Laravel backend for authentication
        const response = await axios.post('/api/login', {
          email: this.email,
          password: this.password
        });

        // Assume the token is returned in the response (response.data.token)
        const token = response.data.token;

        // Store the token (e.g., in localStorage)
        localStorage.setItem('auth_token', token);

        // Redirect to dashboard or another page upon successful login
        this.$router.push({ name: 'HotelSearch' });

      } catch (err) {
        this.error = 'Sign in failed. Please check your credentials.';
      } finally {
        this.loading = false; // End loading state
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
  margin-top: 10px;
}
</style>
