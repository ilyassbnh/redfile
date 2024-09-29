<template>
    <div>
      <h1>Select a location on the map to search for hotels</h1>
      <div id="map" style="height: 400px;"></div>
      <p v-if="latitude && longitude">
        Latitude: {{ latitude }} | Longitude: {{ longitude }}
      </p>
      <button @click="searchHotels">Search Hotels</button>
    </div>
  </template>
  
  <script>
  import L from 'leaflet';
  
  export default {
    data() {
      return {
        latitude: null,
        longitude: null,
        map: null
      };
    },
    mounted() {
      this.initializeMap();
    },
    methods: {
      initializeMap() {
        this.map = L.map('map').setView([51.505, -0.09], 13); // Default view (e.g., London)
  
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(this.map);
  
        // Capture the latitude and longitude on map click
        this.map.on('click', (e) => {
          this.latitude = e.latlng.lat;
          this.longitude = e.latlng.lng;
        });
      },
      searchHotels() {
        if (this.latitude && this.longitude) {
          this.$emit('search-hotels', { latitude: this.latitude, longitude: this.longitude });
        } else {
          alert('Please select a location on the map.');
        }
      }
    }
  };
  </script>
  
  <style scoped>
  #map {
    width: 100%;
    height: 100%;
  }
  </style>
  