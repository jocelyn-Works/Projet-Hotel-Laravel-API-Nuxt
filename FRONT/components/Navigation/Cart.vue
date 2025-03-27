<template>
  <section class="nav fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">
    <div class="flex items-center w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeCart" />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Panier</h2>
    </div>
    <div class="w-full h-full p-4">
      <div class="cart-items-container space-y-4" :class="{'overflow-y-scroll': cartItems.length > 3}">
        <div v-if="cartItems.length" class="space-y-4">
          <div v-for="item in cartItems" :key="item.id" class="border p-4 rounded-lg shadow-md flex flex-col md:flex-row items-center">
            <!-- Affichage de la première image -->
            <div v-if="item.image_paths && item.image_paths.length > 0" class="md:w-1/3 mb-4 md:mb-0">
              <img
                  :src="item.image_paths[0]"
                  class="w-full h-48 object-cover rounded-lg shadow-lg"
                  :alt="`Image de ${item.name}`"
              />
            </div>
            <!-- Informations de la chambre -->
            <div class="md:w-2/3 md:pl-4 text-center md:text-left">
              <h3 class="text-xl font-bold">{{ item.name }}</h3>
              <p class="text-gray-700">{{ item.description || 'Aucune description disponible' }}</p>
              <p class="text-[#1d3557] font-bold">{{ item.price }} € / nuit</p>
              <p class="text-sm italic text-gray-500">Disponibles : {{ item.disponibles }}</p>
              <UButton color="primary" class="m-2" @click="removeFromCart(item.id)">Retirer</UButton>
              <UButton variant="outline" color="primary" @click="openOption">Options</UButton>
            </div>
          </div>
        </div>
        <div v-else class="text-center text-gray-500">
          <p>Votre panier est vide.</p>
        </div>
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




const openOption = () => {
  uiStore.setActiveComponent('option');
};
</script>

<style scoped>

/* Scrollable cart items container */
.cart-items-container {
  max-height: 70vh; /* Ajustez cette valeur selon vos besoins */
}

.overflow-y-scroll {
  overflow-y: auto;
}
</style>
