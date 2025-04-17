<!-- Logo.vue -->
<template>
  <div v-if="hotel" class="logo-container flex justify-center">
    <img :src="hotel.image_url" alt="Hotel Logo" class="w-36 h-auto object-contain">
  </div>
</template>

<script setup>
import { computed } from 'vue';

const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl;

const hotels = ref([]);
try {
  hotels.value = await $fetch(`${apiUrl}/hotel/all`);
} catch (error) {
  console.error("Erreur au chargement du logo :", error);
}
const hotel = computed(() => hotels.value.length ? hotels.value[0] : null);

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