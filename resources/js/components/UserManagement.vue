<template>
    <div>
      <h1>User Management</h1>
      <button @click="showCreateUserForm = !showCreateUserForm">Create User</button>
      <div v-if="showCreateUserForm">
        <form @submit.prevent="createUser">
          <input v-model="newUser.name" placeholder="Name" required />
          <input v-model="newUser.email" placeholder="Email" required />
          <input type="password" v-model="newUser.password" placeholder="Password" required />
          <select v-model="newUser.role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
          <button type="submit">Submit</button>
        </form>
      </div>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }} ({{ user.role }})</li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        users: [],
        newUser: { name: '', email: '', password: '', role: '' },
        showCreateUserForm: false,
      };
    },
    methods: {
      async fetchUsers() {
        try {
          const response = await axios.get('/api/users');
          this.users = response.data;
        } catch (error) {
          console.error('Error fetching users:', error);
        }
      },
      async createUser() {
        try {
          const response = await axios.post('/api/users', this.newUser);
          this.users.push(response.data.user);
          this.newUser = { name: '', email: '', password: '', role: '' };
          alert(response.data.success);
        } catch (error) {
          console.error('Error creating user:', error);
        }
      },
    },
    mounted() {
      this.fetchUsers(); // Fetch users on component mount
    },
  };
  </script>
  