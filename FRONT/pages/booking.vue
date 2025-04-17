<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { useUiStore } from '~/stores/ui';
import { useDatesStore } from '~/stores/dates';
import { useCartStore } from '~/stores/cart';
import { useRouter } from 'vue-router';
import { ref, onMounted, watch } from 'vue';

const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);
const datesStore = useDatesStore();
const cartStore = useCartStore();
const router = useRouter();

const chambresDispo = ref<Room[]>([]);
const loading = ref(true);

interface Room {
  id: number;
  name: string;
  description?: string;
  price: number;
  disponibles: number;
  image_paths?: string[];
}

async function verifierDisponibilite() {
  if (!datesStore.selectedDates.start || !datesStore.selectedDates.end) {
    // console.warn("⚠️ Aucune date sélectionnée, redirection vers l'accueil.");
    router.push('/');
    return;
  }

  console.log("✅ Accès à /booking avec ces dates :", datesStore.selectedDates);

  try {
    const response = await $fetch<{ typesDisponibles: Room[] }>('http://localhost:8000/api/check-availability', {
      method: 'POST',
      body: {
        dateDebut: datesStore.selectedDates.start,
        dateFin: datesStore.selectedDates.end
      }
    });

    if (response.typesDisponibles.length > 0) {
      chambresDispo.value = response.typesDisponibles;
    } else {
      router.push({ path: '/', query: { error: 'Aucune chambre disponible' } });
    }
  } catch (error) {
    console.error('Erreur API', error);
    router.push({ path: '/', query: { error: 'Erreur lors de la vérification des disponibilités' } });
  } finally {
    loading.value = false;
  }
}

const addToCart = (room: Room) => {
  cartStore.addToCart(room);
  console.log('Chambre ajoutée au panier :', room);
};

onMounted(() => {
  verifierDisponibilite();
});

watch(
    () => datesStore.selectedDates,
    () => {
      loading.value = true;
      verifierDisponibilite();
    },
    { deep: true }
);

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

    <!-- Chargement -->
    <div v-if="loading" class="text-center">
      <p>Chargement des chambres...</p>
    </div>

    <!-- Affichage des chambres disponibles -->
    <div v-else-if="chambresDispo.length">
      <div
          v-for="room in chambresDispo"
          :key="room.id"
          class="bg-[#fdf8f1] p-6 rounded-lg shadow-lg flex flex-col lg:flex-row items-center"
      >
        <!-- Images (grille 2x2 comme dans RoomTypes.vue) -->
        <div class="lg:w-1/2 grid grid-cols-2 gap-4">
          <img
              v-for="(img, index) in room.image_paths?.slice(0, 4)"
              :key="index"
              :src="img"
              class="w-full h-48 object-cover rounded-lg shadow-lg transition-transform duration-300 hover:scale-105"
              :alt="`Image ${index + 1} de ${room.name}`"
          />
        </div>

        <!-- Infos -->
        <div class="lg:w-1/2 lg:pl-8 mt-4 lg:mt-0">
          <h2 class="text-xl font-bold mb-2">{{ room.name }}</h2>
          <p class="text-gray-700 mb-2">{{ room.description || 'Aucune description disponible' }}</p>
          <p class="text-[#1d3557] font-bold mb-2">{{ room.price }} € / nuit</p>
          <p class="text-sm italic text-gray-500 mb-4">Disponibles : {{ room.disponibles }}</p>

          <UButton color="primary" class="ml-2" @click="addToCart(room)">Sélectionner</UButton>
        </div>
      </div>
    </div>

    <!-- Message si aucune chambre -->
    <div v-else class="text-center text-red-500 font-bold">
      <p>Aucune chambre disponible pour ces dates.</p>
    </div>
  </UContainer>
</template>

  
  
