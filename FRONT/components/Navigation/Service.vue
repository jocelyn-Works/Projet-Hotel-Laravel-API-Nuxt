<template>
  <section
      class="nav fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10"
  >
    <!-- En-tête -->
    <div class="flex w-full bg-dark-blue-500 p-4">
      <UIcon
          name="heroicons-solid:x-mark"
          class="w-6 h-6 text-white cursor-pointer"
          @click="closeService"
      />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">
        Services
      </h2>
    </div>

    <!-- Liste des services -->
    <div class="flex justify-center flex-row flex-wrap w-full p-2">
      <p v-if="serviceStore.loading">Chargement...</p>
      <p v-if="serviceStore.error" class="error">{{ serviceStore.error }}</p>

      <div v-if="!serviceStore.loading && !serviceStore.error">
        <template v-if="serviceStore.services.length">
          <div v-for="service in serviceStore.services" :key="service.id" class="m-2">
            <div class="flex items-center gap-2">

              <div class="inline-flex items-center">
                <label class="flex items-center cursor-pointer relative">
                  <input  v-model="selectedServices" :value="service.id" defaultChecked type="checkbox" class="peer h-6 w-6 cursor-pointer transition-all appearance-none rounded-full bg-slate-100 shadow hover:shadow-md border border-slate-300 checked:bg-slate-800 checked:border-slate-800" id="check-custom-style" />
                  <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    </span>
                </label>
              </div>

              <div
                  class="p-4 border border-gold-500 cursor-pointer bg-dark-blue-400 text-white rounded-xl text-center text-base sm:text-xl
                transition-all duration-300 ease-in-out transform hover:bg-dark-blue-300 hover:-translate-y-1 hover:shadow-lg
                active:translate-y-0 active:shadow-md"
              >
                <span>{{ service.name }} / {{ service.price }} €</span>
              </div>
            </div>
          </div>
        </template>
        <p v-else>Aucun service disponible.</p>
      </div>
    </div>

    <!-- Affichage des descriptions des services sélectionnés -->
    <div v-if="selectedServiceDetails.length" class="p-4 bg-dark-blue-600 text-white rounded-md mt-4">
      <h3 class="text-lg font-bold mb-2">Services sélectionnés :</h3>
      <ul class="list-disc pl-5">
        <li v-for="service in selectedServiceDetails" :key="service.id" class="mb-2">
          <strong>{{ service.name }} :</strong>   {{service.price}}€ {{ service.description }}
        </li>
      </ul>
    </div>

    <!-- Boutons d'action -->
    <div class="w-full flex justify-around items-center mt-4 p-4">
      <UButton variant="outline" color="primary" @click="confirmSelection">
        Confirmer
      </UButton>
      <UButton color="primary" @click="clearSelection">
        Réinitialiser
      </UButton>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, watch } from "vue";

// Store des services
const serviceStore = useServiceStore();
const uiStore = useUiStore();

// Stocker les services sélectionnés
const selectedServices = ref<number[]>([]);

// Calculer les détails des services sélectionnés
const selectedServiceDetails = computed(() => {
  return serviceStore.services.filter(service => selectedServices.value.includes(service.id));
});

onMounted(() => {
  serviceStore.fetchServices();
});

// Fonction pour fermer le composant
const closeService = () => {
  uiStore.closeComponent();
};

// Confirmer la sélection des services
const confirmSelection = () => {
  console.log("Services sélectionnés :", selectedServiceDetails.value);
  // Ici, tu peux envoyer la sélection à l'API ou l'associer à une chambre
};

// Réinitialiser la sélection
const clearSelection = () => {
  selectedServices.value = [];
};

// Gérer les erreurs (optionnel)
watch(() => serviceStore.error, (newError) => {
  if (newError) {
    alert("Erreur lors du chargement des services : " + newError);
  }
});
</script>

<style scoped>
/* Ajoute des styles si nécessaire */
</style>
