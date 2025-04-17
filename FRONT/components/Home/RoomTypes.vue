<script setup lang="ts">
import { ref } from 'vue';

// Récupération de l'URL de l'API depuis les variables d'environnement
const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl;

// Interface décrivant la structure des types de chambre
interface RoomType {
  id: number;
  name: string;
  description: string;
  price: string;
  image_paths: string[];
}

// Variables réactives pour stocker les données récupérées
const roomTypes = ref<RoomType[]>([]);
const selectedRoom = ref<RoomType | null>(null);

// Fonction pour récupérer tous les types de chambres depuis l'API
const { data, error } = await useAsyncData<RoomType[]>("roomTypes", () =>
    $fetch(`${apiUrl}/type/all`)
);

// Gestion des erreurs de récupération des données
if (error.value) {
  console.error("Erreur lors de la récupération des types de chambres :", error.value);
}

// Si des données sont récupérées avec succès
if (data.value) {
  roomTypes.value = data.value;

  // Sélection automatique de la première chambre disponible
  if (roomTypes.value.length > 0) {
    selectedRoom.value = roomTypes.value[0];
  }
}

// Fonction pour sélectionner une chambre au clic
const selectRoom = (room: RoomType) => {
  selectedRoom.value = room;
};



const uiStore = useUiStore();

const openDates = () => {
  uiStore.setActiveComponent('dates');
};
</script>

<template>
  <div class="py-16 mt-5">
    <div class="container mx-auto">

      <!-- Menu des types de chambres -->
      <div class="flex justify-center space-x-8 mb-8">
        <a
            v-for="room in roomTypes"
            :key="room.id"
            href="#"
            @click.prevent="selectRoom(room)"
            class="text-xl font-semibold transition-colors duration-300"
            :class="selectedRoom?.id === room.id ? 'underline text-gold-700' : 'text-gray-700 hover:text-gold-700'"
        >
          {{ room.name }}
        </a>
      </div>

      <!-- Affichage des détails de la chambre sélectionnée -->
      <div v-if="selectedRoom" class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Colonne gauche : Galerie d'images -->
        <div class="grid grid-cols-2 gap-4">
          <!-- Affichage des 4 premières images de la chambre sélectionnée -->
          <img
              v-for="(img, index) in selectedRoom.image_paths.slice(0, 4)"
              :key="index"
              :src="img"
              class="w-full h-48 object-cover rounded-lg shadow-lg transition-transform duration-300 hover:scale-105"
          >
        </div>

        <!-- Colonne droite : Informations sur la chambre -->
        <div class=" p-6 shadow-xl rounded-lg flex flex-col h-full">
          <!-- Titre centré horizontalement -->
          <h2 class="text-3xl font-bold text-gray-800 mb-3 text-center">
            {{ selectedRoom.name }}
          </h2>

          <!-- Description centrée verticalement et horizontalement -->
          <div class="flex-grow flex items-center">
            <p class="text-gray-600 leading-relaxed text-center">
              {{ selectedRoom.description }}
            </p>
          </div>

          <!-- Prix + bouton centré horizontalement -->
          <div class="mt-4 text-center">
            <p class="text-2xl font-semibold text-gold-500 mb-4">
              {{ selectedRoom.price }}€ <span class="text-base font-normal">/ nuit</span>
            </p>

            <button @click="openDates" class="bg-dark-blue-400 hover:bg-gold-500 text-white font-semibold py-2 px-4 rounded-md transition-colors">


              Réserver
            </button>
          </div>
        </div>

      </div>

      <!-- Message affiché si aucune chambre n'est sélectionnée -->
      <div v-else class="text-center text-gray-500">
        <p>Sélectionnez un type de chambre pour voir les détails.</p>
      </div>

    </div>
  </div>
</template>