require('./bootstrap'); // Charge Bootstrap et autres dépendances

import Vue from 'vue/dist/vue.esm'; // Importer la version complète

// Si tu veux enregistrer un composant
// import MyComponent from './components/MyComponent.vue';
// Vue.component('my-component', MyComponent);

const app = new Vue({
    el: '#app',
    data: {
        // Ajoute tes données ici
    },
    methods: {
        // Ajoute tes méthodes ici
    }
});
