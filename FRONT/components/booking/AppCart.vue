<template>
    <nav class="fixed top-0 right-0 mr-6 mt-8 z-10 rounded bg-dark-blue-500 bg-opacity-80">
      <div class="flex items-center justify-center w-14 h-14 p-2" @click="openCart" >
        <UIcon name="subway:basket" class="w-full h-full cursor-pointer bg-white" />
      </div>
    </nav>
</template>

<script setup>
import { useUiStore } from '~/stores/ui';

const uiStore = useUiStore();

const openCart = () => {
  uiStore.setActiveComponent('cart');
};
</script>