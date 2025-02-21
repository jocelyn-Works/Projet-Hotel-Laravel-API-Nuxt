<template>
  <footer class="bg-dark-blue-500 p-4 sm:p-6 text-white">
    <!-- Informations de l'hôtel -->
    <div class="flex justify-center flex-col md:flex-row  items-center text-center md:text-left space-y-2 md:space-y-0 font-bold">
      <template v-if="dataHotel && dataHotel.length > 0">
        <div class="text-sm">
          {{ dataHotel[0].phone_number }} | {{ dataHotel[0].street }} | {{ dataHotel[0].city }} | {{ dataHotel[0].email }}
        </div>
      </template>
      <div v-else class="text-sm">Aucune donnée</div>
    </div>

  

    <!-- Bas du footer -->
    <div class=" p-2 flex flex-col md:flex-row justify-between items-center text-center md:text-left space-y-4 md:space-y-0">
      <!-- Copyright -->
      <div class="text-sm font-bold">
        &copy; {{ currentYear }} {{ dataHotel[0]?.name }} - {{ dataHotel[0]?.city }}
      </div>

      <!-- Réseaux sociaux -->
      <div class="flex justify-center md:justify-end gap-4">
        <template v-if="dataSocial && dataSocial.length > 0">
          <a v-for="social in dataSocial" :key="social.id" :href="'https://' + social.url" target="_blank">
            <img :src="social.image_url" :alt="social.url" class="w-6 h-6 hover:opacity-75 transition">
          </a>
        </template>
        <div v-else class="text-sm">Aucune donnée de réseaux sociaux.</div>
      </div>
    </div>
  </footer>
</template>

<script setup>
const apiUrl = import.meta.env.VITE_API_URL;

// Hôtel
const { data: dataHotel } = await useFetch(`${apiUrl}/home/hotel`);

// Année actuelle
const currentYear = new Date().getFullYear();

// Réseaux sociaux
const { data: dataSocial } = await useFetch(`${apiUrl}/home/social`);
</script>
