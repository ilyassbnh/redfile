import { createRouter, createWebHistory } from 'vue-router';
import Login from '../../../resources/components/Login.vue';
import MainLayout from '../../../resources/components/MainLayout.vue';
import HotelSearch from '../../../resources/components/HotelSearch.vue';
import HotelDetails from '../../../resources/components/HotelDetails.vue';
import Register from '../../../resources/components/Register.vue';

const routes = [
    {
        path: '/register',
        component: Register
    },
    {
        path: '/',
        redirect: '/login' // Redirect to login page
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/main',
        component: MainLayout,
        children: [
            {
                path: '',
                component: HotelSearch, 
            },
            {
                path: 'hotel-search',
                component: HotelSearch,
            },
            {
                path: 'hotel/:id', // Dynamic route for hotel details
                component: HotelDetails,
                name: 'HotelDetails',
            }
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
