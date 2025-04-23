<template>
  <div v-if="hotel" class="logo-container flex justify-center">
    <img :src="hotel.image_url" alt="Hotel Logo" class="w-36 h-auto object-contain">
  </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue'

// Appel de l'API via le helper global
const { data, error } = await useApi<{ image_url: string }[]>('/hotel/all')

// Stockage des hôtels retournés
const hotels = ref(data.value || [])

// Sélection du premier hôtel (s'il existe)
const hotel = computed(() => hotels.value.length > 0 ? hotels.value[0] : null)

// Gestion des erreurs (affichée en console seulement)
if (error.value) {
  console.error("Erreur au chargement du logo :", error.value)
}
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
