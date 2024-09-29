<template>
    <div>
      <h1>Hotel Details</h1>
      <div v-if="hotelDetails">
        <img :src="hotelDetails.image_url" alt="Hotel Image" />
        <p>Price: {{ hotelDetails.price }}</p>
        <p>Services: {{ hotelDetails.services.join(', ') }}</p>
        <!-- Add other details here -->
      </div>
      <div v-else>
        Loading hotel details...
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        hotelDetails: null,
      };
    },
    created() {
      this.fetchHotelDetails();
    },
    methods: {
      async fetchHotelDetails() {
        try {
          const response = await axios.get(`http://localhost:8000/api/hotel/details/${this.$route.params.id}`, {
            params: {
              arrival_date: '2024-10-01', // Adjust as needed
              departure_date: '2024-10-09',
              adults: 1,
              children_age: '1,17',
              room_qty: 1,
            },
          });
          this.hotelDetails = response.data;
        } catch (error) {
          console.error('Error fetching hotel details:', error);
        }
      },
    },
  };
  </script>
  