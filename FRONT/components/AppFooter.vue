<template>
    <footer class="bg-dark-blue-500 p-3">
      <div class="flex justify-center">
        <template v-if="dataHotel && dataHotel.length > 0">
          {{ dataHotel[0].phone_number }} | {{ dataHotel[0].street }} | {{ dataHotel[0].city }} | {{ dataHotel[0].email }}
        </template>
        <div v-else>
          Aucune doonés
        </div>
      </div>
      <div class="flex justify-around">
        <div class=""> &copy;Copyright {{ currentYear }} {{ dataHotel[0].name }} {{ dataHotel[0].city }}</div>
    
        
        <template v-if="dataSocial && dataSocial.length > 0">
          <a v-for="social in dataSocial" :key="social.id" :href="'https://' + social.url" target="_blank">
            <img :src="social.image_url" :alt="social.url" class="w-6 h-6">
          </a>
        </template>
        <div v-else>
          Aucune donnée de réseaux sociaux disponible.
        </div>
      </div>
    </footer>
  </template>
  
  <script setup>
    const apiUrl = import.meta.env.VITE_API_URL;
  
  // hôtel
    const { data: dataHotel } = await useFetch(`${apiUrl}/home/hotel`);

  // année actuelle
    const currentYear = new Date().getFullYear();
  
  // réseaux sociaux
    const { data: dataSocial } = await useFetch(`${apiUrl}/home/social`);

  </script>
  