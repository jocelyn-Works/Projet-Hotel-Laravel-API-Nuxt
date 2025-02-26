<template>

<div class="absolute bottom-40 left-1/2 transform -translate-x-1/2">
    <button @click="openDates"  class="flex items-center p-3 rounded-lg  bg-dark-blue-500 border border-theme-500  cursor-pointer">
        <UIcon name="heroicons-solid:calendar" class="w-10 h-10  bg-theme-500" />
        <p class=" mx-4 text-2xl  text-theme-500">Dates</p>
    </button>
</div>

    
  

</template>

<script setup>

import { useUiStore } from '~/stores/ui';

const uiStore = useUiStore();

const openDates = () => {
  uiStore.setActiveComponent('dates');
};

</script>

