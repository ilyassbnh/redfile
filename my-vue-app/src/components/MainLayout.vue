<template>
    <div>
      <nav>
        <router-link to="/">Home</router-link>
        <router-link to="/hotel-search">Hotel Search</router-link>
      </nav>
      <main>
        <router-view />
      </main>
    </div>
  </template>
  
  <script>
  export default {
    name: 'MainLayout',
  };
  </script>
  