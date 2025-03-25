<script setup>
import { storeToRefs } from 'pinia';
import { useUiStore } from '~/stores/ui';
import { useDatesStore } from '~/stores/dates'; // Import du store des dates
import { useRouter } from 'vue-router';
import { ref, watchEffect } from 'vue';

const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);
const datesStore = useDatesStore(); // Store des dates
const router = useRouter();

const chambresDispo = ref([]);
const loading = ref(true); // Gestion du chargement

// Vérification et récupération des chambres disponibles
async function verifierDisponibilite() {
  if (!datesStore.selectedDates.start || !datesStore.selectedDates.end) {
    console.warn("⚠️ Aucune date sélectionnée, redirection vers l'accueil.");
    router.push('/'); // Redirection vers l'accueil si pas de dates
    return;
  }

  // 🔍 Affichage des dates pour vérification
  console.log("✅ Accès à /booking avec ces dates :", datesStore.selectedDates);

  // 🚨 Désactive temporairement l'appel API
  // try {
  //   const response = await $fetch('/api/check-availability', {
  //     method: 'POST',
  //     body: {
  //       dateDebut: datesStore.selectedDates.start,
  //       dateFin: datesStore.selectedDates.end
  //     }
  //   });

  //   if (response.chambresDispo.length > 0) {
  //     chambresDispo.value = response.chambresDispo;
  //   } else {
  //     router.push({ path: '/', query: { error: 'Aucune chambre disponible' } });
  //   }
  // } catch (error) {
  //   console.error('Erreur API', error);
  //   router.push({ path: '/', query: { error: 'Erreur lors de la vérification des disponibilités' } });
  // } finally {
  //   loading.value = false;
  // }

  // Simule des chambres disponibles pour tester l'affichage
  chambresDispo.value = [
    { id: 1, type: 'Chambre Standard', prix: 100, image: 'https://via.placeholder.com/600x400' },
    { id: 2, type: 'Chambre Luxe', prix: 250, image: 'https://via.placeholder.com/600x400' },
    { id: 3, type: 'Suite', prix: 500, image: 'https://via.placeholder.com/600x400' }
  ];

  loading.value = false; // Arrêter le chargement
}

// Appelle la fonction à l’arrivée sur la page
watchEffect(() => {
  verifierDisponibilite();
});
</script>

<template>
  <BookingAppCart />

  <transition name="slide">
    <NavigationCart v-if="activeComponent === 'cart'" />
  </transition>

  <Logo />
  <UContainer class="py-8 space-y-8">
    <div class="text-center mb-8 dark:text-black">
      <ButtonDateBooking />
    </div>

    <!-- Gestion du chargement -->
    <div v-if="loading" class="text-center">
      <p>Chargement des chambres...</p>
    </div>

    <!-- Affichage dynamique des chambres disponibles -->
    <div v-else-if="chambresDispo.length">
      <div v-for="room in chambresDispo" :key="room.id" class="bg-[#fdf8f1] p-6 rounded-lg shadow-lg flex flex-col lg:flex-row items-center">
        <div class="lg:w-1/2">
          <img :src="room.image" :alt="room.type" class="rounded-lg" />
        </div>
        <div class="lg:w-1/2 lg:pl-8 mt-4 lg:mt-0">
          <h2 class="text-xl font-bold mb-4">{{ room.type }}</h2>
          <p class="text-gray-700 mb-4">{{ room.description || 'Aucune description disponible' }}</p>
          <p class="text-[#1d3557] font-bold mb-4">{{ room.prix }} € / nuit</p>
          <UButton variant="outline" color="primary">Options</UButton>
          <UButton color="primary" class="ml-2">Sélectionner</UButton>
        </div>
      </div>
    </div>

    <!-- Message si aucune chambre n'est trouvée -->
    <div v-else class="text-center text-red-500 font-bold">
      <p>Aucune chambre disponible pour ces dates.</p>
    </div>
  </UContainer>
</template>
