<template>
  <nav class="fixed top-0 left-0 ml-6 mt-8 z-10 rounded bg-dark-blue-500 bg-opacity-80">
    <div class="flex items-center justify-center w-14 h-14 p-2" @click="openNavigation">
      <UIcon name="proicons:text-description" class="w-full h-full cursor-pointer" />
    </div>
  </nav>
</template>

<script setup>
import { useUiStore } from '~/stores/ui';

const uiStore = useUiStore();

const openNavigation = () => {
  uiStore.setActiveComponent('navigation');
};
</script>
