<script setup lang="ts">
const apiUrl = import.meta.env.VITE_API_URL
const { data, error } = await useFetch(`${apiUrl}/home/main`
);

console.log("Données reçues :", data.value);
</script>

<template>
  <div class="py-8 bg-[#EDE4D9]">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-6">Découvrez notre hôtel</h2>

      <!-- Debugging: Afficher les données JSON -->
<!--      <pre class="bg-gray-100 p-4 rounded text-sm">{{ data }}</pre>-->

      <!-- Vérifie si `data` contient bien un tableau avant d'afficher -->
      <div v-if="data?.length" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="(main, index) in data" :key="main.id" class="text-center">
          <img :src="main.image_url"
               class="w-full h-64 object-cover rounded-lg shadow-lg"
               :alt="'Image ' + index"
               loading="lazy">
          <p class="mt-4 text-lg text-gray-700 px-4">{{ main.content }}</p>
        </div>
      </div>

      <p v-else class="text-center text-gray-600">Chargement des images...</p>
    </div>
  </div>
</template>