<template>
  <div>
    <MainLayout />
    <Chatbot />
  </div>
</template>
<script>
import Chatbot from './components/Chatbot.vue';
import MainLayout from './components/MainLayout.vue';
export default {
  components: {
    Chatbot,
    MainLayout,
  },
};
</script>
