<template>
    <div v-if="hotelDetails">
        <h1>{{ hotelDetails.name }}</h1>
        <img :src="hotelDetails.image_url" alt="Hotel Image" />
        <p>Price: {{ hotelDetails.price }}</p>
        <p>Services: {{ hotelDetails.services.join(', ') }}</p>
    </div>
    <div v-else-if="error">
        <p>Error loading hotel details.</p>
    </div>
    <div v-else>
        <p>Loading hotel details...</p>
    </div>
</template>

  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
        return {
            hotelDetails: null,
            loading: true,
        };
    },
    mounted() {
        const hotelId = this.$route.params.hotelId; // Ensure you're getting the hotel ID correctly
        this.fetchHotelDetails(hotelId);
    },
    methods: {
        async fetchHotelDetails(hotelId) {
            try {
                const response = await axios.get(`http://localhost:8000/api/hotel/details/${hotelId}`, {
                    params: {
                        arrival_date: '2024-10-01',
                        departure_date: '2024-10-09',
                        adults: 1,
                        children_age: '1,17',
                        room_qty: 1,
                    },
                });
                this.hotelDetails = response.data; 
            } catch (error) {
                console.error('Error fetching hotel details:', error);
            } finally {
                this.loading = false;
            }
        },
    },
};

  </script>
  