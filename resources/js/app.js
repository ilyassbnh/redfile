import { createApp } from 'vue';
import App from '../../my-vue-app/src/App.vue';
import router from '../../my-vue-app/src/router'; // Import the router
import './bootstrap';

createApp(App)
  .use(router) // Use the router
  .mount('#app');

