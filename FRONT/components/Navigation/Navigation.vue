<template>

    <nav class="fixed top-0 left-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-br-lg z-10">
      <div class="flex justify-between items-center bg-dark-blue-500 p-4">
        <ButtonLogin  />
        <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeNavigation" />
      </div>
      <div class="p-6 satisfy text-dark-blue-500">
        <ul class="text-2xl p-5 m-3">
            <li>
              <NuxtLink to="/" class="hover:text-gold-300">Accueil</NuxtLink>
            </li>
            <li>
              <NuxtLink to="/booking" class="hover:text-gold-300">Booking</NuxtLink></li>
            <li>Mes reservations</li>
            <li>Chambres et suites</li>
            <li>Bars et Restaurants</li>
        </ul>
      </div>
      <AppFooter class="rounded-br-lg" />
    </nav>

  </template>
  
  <script setup>
import { ButtonLogin } from '#components';
import { useUiStore } from '~/stores/ui';

const uiStore = useUiStore();

const closeNavigation = () => {
  uiStore.closeComponent();
};
</script>

<style scoped>
/* Transition styles */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.4s ease;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateX(-100%);
}

.slide-enter-to,
.slide-leave-from {
  transform: translateX(0);
}
</style>


  