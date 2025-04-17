<script setup>
const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl;

const { data, error } = await useFetch(`${apiUrl}/main/all`
);

// console.log("Données reçues :", data.value);
</script>

<template>
  <div class="py-8  p-2">
    <div class="container mx-auto">
      <div v-if="data?.length" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="(main, index) in data" :key="main.id" class="text-center">
          <img :src="main.image_url"
               class="w-full h-64 object-cover rounded-lg shadow-lg"
               :alt="'Image ' + index"
               loading="lazy">
          <p class=" tahoma mt-4 text-lg font-bold text-justify text-gray-700 p-3 mx-3 px-4 ">{{ main.content }}</p>
        </div>
      </div>

      <p v-else class="text-center text-gray-600">Chargement des images...</p>
    </div>
  </div>
</template>

<style>

</style>