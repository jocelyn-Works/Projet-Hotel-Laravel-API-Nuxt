<template>
  <section class="nav fixed top-0 right-0 w-full sm:w-4/5 md:w-3/5 lg:w-2/5 max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl
      bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">

    <div class="flex items-center w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeCart" />
      <h2 class="text-theme-500 text-2xl sm:text-3xl md:text-4xl satisfy flex-grow text-center">Panier</h2>
    </div>

    <!-- Conteneur défilant -->
    <div class="w-full h-full p-4">
      <div
          class="space-y-4 h-[80vh] sm:h-[85vh] md:h-auto max-h-[750px] overflow-y-auto
        scrollbar-thin scrollbar-track-zinc-800 scrollbar-thumb-zinc-500 dark:scrollbar-track-zinc-800"
          :class="{'overflow-y-auto': cartItems.length > 3}"
      >
        <div v-if="cartItems.length" class="space-y-4">
          <div v-for="item in cartItems" :key="item.id" class="p-4 rounded-lg flex flex-col md:flex-row items-center">

            <!-- Affichage de la première image -->
            <div v-if="item.image_paths && item.image_paths.length > 0" class="md:w-1/3 w-full mb-4 md:mb-0">
              <img
                  :src="item.image_paths[0]"
                  class="w-full h-40 sm:h-48 object-cover rounded-lg shadow-lg"
                  :alt="`Image de ${item.name}`"
              />
            </div>

            <!-- Informations de la chambre -->
            <div class="md:w-2/3 md:pl-4 text-center md:text-left">
              <h3 class="text-lg sm:text-xl font-bold">{{ item.name }}</h3>
              <p class="text-gray-700 text-sm sm:text-base">{{ item.description || 'Aucune description disponible' }}</p>
              <p class="text-[#1d3557] font-bold text-sm sm:text-base">{{ item.price }} € / nuit</p>
              <p class="text-sm italic text-gray-500">Disponibles : {{ item.disponibles }}</p>
              <div class="flex flex-wrap justify-between md:justify-start mt-2">
                <UButton color="primary" class="p-2.5 text-xs sm:text-sm mr-4" @click="removeFromCart(item.id)">Retirer</UButton>
                <UButton variant="outline" color="primary" class=" p-2.5 text-xs sm:text-sm" @click="openService">Options</UButton>
              </div>
            </div>
          </div>
        </div>

        <div v-else class="text-center text-gray-500">
          <p>Votre panier est vide.</p>
        </div>
      </div>

      <!-- Bouton de paiement -->
      <div class="flex flex-wrap justify-center p-2">
        <button class="bg-dark-blue-400 text-white rounded-full text-lg sm:text-2xl px-3 sm:px-4 py-2
              transition-all duration-300 ease-in-out transform hover:bg-dark-blue-300 hover:-translate-y-1 hover:shadow-lg
              active:translate-y-0 active:shadow-md">
          Payer
        </button>
      </div>
    </div>
  </section>
</template>



<script setup lang="ts">
import { useUiStore } from '~/stores/ui';
import { useCartStore } from '~/stores/cart';
import { storeToRefs } from 'pinia';

const uiStore = useUiStore();
const cartStore = useCartStore();
const { items: cartItems } = storeToRefs(cartStore);

const closeCart = () => {
  uiStore.closeComponent();
};

const removeFromCart = (roomId: number) => {
  cartStore.removeFromCart(roomId);
};

const openService = () => {

  uiStore.setActiveComponent('service');
};
</script>

<style scoped>

</style>
