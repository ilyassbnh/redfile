// src/main.js
import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Import the router
import 'leaflet/dist/leaflet.css';
import 'bootstrap/dist/css/bootstrap.min.css';



const app = createApp(App);
app.use(router); // Use the router
app.mount('#app');
