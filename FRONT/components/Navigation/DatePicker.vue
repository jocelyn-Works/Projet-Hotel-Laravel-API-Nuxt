<template>

    <section class="fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">

      <div class="flex items-center w-full bg-dark-blue-500 p-4">
        <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeDates" />
        <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Vos Dates</h2>
      </div>
      <div class="w-full h-full p-4">


        <div class="">

        </div>


        
      </div>

      


    </section>

  </template>

<script setup>
import { useUiStore } from '~/stores/ui';

const uiStore = useUiStore();

const closeDates = () => {
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
  transform: translateX(100%);
}

.slide-enter-to,
.slide-leave-from {
  transform: translateX(0);
}
</style>

  