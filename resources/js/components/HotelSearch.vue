<template>
    <div>
      <h1>Search Hotels</h1>
      <Map @search-hotels="searchHotels" />
  
      <div v-if="hotels.length">
        <h2>Available Hotels</h2>
        <ul>
          <li v-for="hotel in hotels" :key="hotel.hotel_id">{{ hotel.hotel_name }}</li>
        </ul>
      </div>
  
      <p v-if="error">{{ error }}</p>
      <div v-for="hotel in hotels" :key="hotel.id">
      <h2>{{ hotel.name }}</h2>
      <router-link :to="{ name: 'HotelDetails', params: { hotelId: hotel.id } }">View Details</router-link>
    </div>
    </div>
  </template>
  
  <script>
  import Map from './Map.vue';
  import axios from 'axios';
  
  export default {
    components: {
      Map
    },
    data() {
      return {
        hotels: [],
        error: ''
      };
    },
    methods: {
      async searchHotels({ latitude, longitude }) {
        try {
          const response = await axios.get('https://booking-com.p.rapidapi.com/v1/hotels/search-by-coordinates', {
            params: {
              adults_number: 2,
              checkin_date: '2025-01-18',
              checkout_date: '2025-01-19',
              children_number: 2,
              locale: 'en-gb',
              room_number: 1,
              units: 'metric',
              filter_by_currency: 'AED',
              latitude: latitude,
              longitude: longitude,
              order_by: 'popularity',
              include_adjacency: 1,
              page_number: 0,
              categories_filter_ids: 'class::2,class::4,free_cancellation::1'
            },
            headers: {
              'x-rapidapi-host': 'booking-com.p.rapidapi.com',
              'x-rapidapi-key': '9d1b5dd2c7mshe5be64a37890943p1344e3jsn4103bbc7ac5c'
            }
          });
          this.hotels = response.data.result;
        } catch (error) {
          this.error = error.response ? error.response.data.message : error.message;
        }
      }
    }
  };
  </script>
  