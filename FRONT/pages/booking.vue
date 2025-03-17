<script setup >
import { storeToRefs } from 'pinia';
import { useUiStore } from '~/stores/ui';


const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);

const rooms = [
  {
    id: 1,
    title: 'Chambre Standard',
    image: 'https://via.placeholder.com/600x400',
    description: 'Lorem ipsum is simply dummy text of the printing and typesetting industry...',
    price: '250€ / prix dynamique',
  },
  {
    id: 2,
    title: 'Chambre de Luxe',
    image: 'https://via.placeholder.com/600x400',
    description: 'Lorem ipsum is simply dummy text of the printing and typesetting industry...',
    price: '549€/nuit/personne',
  },
  {
    id: 3,
    title: 'Suite',
    image: 'https://via.placeholder.com/600x400',
    description: 'Lorem ipsum is simply dummy text of the printing and typesetting industry...',
    price: '1200€/nuit/personne',
  },
];
</script>

<template>
  <BookingAppCart />


  <transition name="slide">
    <NavigationCart v-if="activeComponent === 'cart'" />
  </transition>


  <Logo />
  <UContainer class="py-8 space-y-8 ">
    <div class="text-center mb-8">
      <ButtonDateBooking />
<!--      <UButton color="primary">Dates</UButton>-->
    </div>

    <div v-for="room in rooms" :key="room.id" class="bg-[#fdf8f1] p-6 rounded-lg shadow-lg flex flex-col lg:flex-row items-center">
      <div class="lg:w-1/2">
        <img :src="room.image" :alt="room.title" class="rounded-lg" />
      </div>
      <div class="lg:w-1/2 lg:pl-8 mt-4 lg:mt-0">
        <h2 class="text-xl font-bold mb-4">{{ room.title }}</h2>
        <p class="text-gray-700 mb-4">{{ room.description }}</p>
        <p class="text-[#1d3557] font-bold mb-4">{{ room.price }}</p>
        <UButton variant="outline" color="primary">Options</UButton>
        <UButton color="primary" class="ml-2">Sélectionner</UButton>
      </div>
    </div>

  </UContainer>
</template>