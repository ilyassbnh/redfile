import { createRouter, createWebHistory } from 'vue-router';
import MainLayout from '../components/MainLayout.vue';
import HotelSearch from '../components/HotelSearch.vue';
import HotelDetails from '../components/HotelDetails.vue'; // Ensure this path is correct

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: '',
        component: HotelSearch, // Render HotelSearch when on home path
      },
      {
        path: 'hotel-search',
        component: HotelSearch,
      },
      {
        path: 'hotel/:id', // Dynamic route for hotel details
        component: HotelDetails,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
