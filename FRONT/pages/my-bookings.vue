<template>
  <UContainer class="py-10 space-y-8">
    <h1 class="text-3xl font-bold text-center text-dark-blue-500">Mes Réservations</h1>

    <!-- Chargement -->
    <div v-if="loading" class="text-center text-gray-500 text-lg">
      Chargement de vos réservations...
    </div>

    <!-- Aucune réservation -->
    <div v-else-if="bookings.length === 0" class="text-center text-gray-400 text-xl italic">
      Vous n'avez encore effectué aucune réservation.
    </div>

    <!-- Liste des réservations -->
    <div v-else class="grid gap-6">
      <div
          v-for="booking in bookings"
          :key="booking.id"
          class="bg-white border-l-4 border-dark-blue-500 shadow-lg rounded-lg p-6"
      >
        <h2 class="text-xl font-semibold text-dark-blue-500 mb-2">
          Réservation #{{ booking.id }}
        </h2>
        <div class="grid md:grid-cols-2 gap-2 text-gray-700">
          <p><strong>Chambre :</strong> {{ booking.room?.number || 'N/A' }}</p>
          <p><strong>Type :</strong> {{ booking.room?.type?.name || 'N/A' }}</p>
          <p><strong>Du :</strong> {{ formatDate(booking.start_date) }}</p>
          <p><strong>Au :</strong> {{ formatDate(booking.end_date) }}</p>
          <p><strong>Quantité :</strong> {{ booking.quantity }}</p>
          <p><strong>Statut :</strong> <span :class="statusColor(booking.status)">{{ booking.status }}</span></p>
        </div>
      </div>
    </div>
  </UContainer>
</template>

<script setup>
import { useUserStore } from '~/stores/user';
import { onMounted, ref } from 'vue';
import { format } from 'date-fns';
import fr from 'date-fns/locale/fr';

const bookings = ref([]);
const loading = ref(true);
const apiUrl = import.meta.env.VITE_API_URL;
const userStore = useUserStore();

// Formattage de date lisible (ex: 5 avril 2025)
const formatDate = (date) => {
  return format(new Date(date), "dd MMMM yyyy", { locale: fr });
};

// Couleur selon le statut
const statusColor = (status) => {
  switch (status) {
    case 'Accepted':
      return 'text-green-600 font-semibold';
    case 'Rejected':
      return 'text-red-600 font-semibold';
    case 'Pending':
    default:
      return 'text-yellow-600 font-semibold';
  }
};

// Chargement des réservations
onMounted(async () => {
  try {
    const response = await $fetch(`${apiUrl}/user/bookings`, {
      method: 'GET',
      headers: {
        Authorization: `Bearer ${userStore.token}`,
      },
    });

    bookings.value = response.bookings || [];
  } catch (error) {
    console.error("Erreur lors de la récupération des réservations :", error);
  } finally {
    loading.value = false;
  }
});
</script>