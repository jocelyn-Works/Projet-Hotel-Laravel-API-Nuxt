<!-- Logo.vue -->
<template>
  <div v-if="hotel" class="logo-container flex justify-center">
    <img :src="hotel.image_url" alt="Hotel Logo" class="w-36 h-auto object-contain">
  </div>
</template>

<script setup>
import { computed } from 'vue';

const apiUrl = import.meta.env.VITE_API_URL;
const { data: hotels, error } = await useFetch(`${apiUrl}/hotel/all`);

if (error.value) {
  console.error('Erreur au chargement du logo :', error.value);
}

const hotel = computed(() => hotels.value ? hotels.value[0] : null);

</script>

<style scoped>
.logo-container {
  padding: 1rem 0;
}
.logo-container img {
  width: 144px;
  height: auto;
}
</style>