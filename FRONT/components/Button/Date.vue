<template>

<div class="absolute bottom-40 left-1/2 transform -translate-x-1/2">
    <button @click="toggleDates"  class="flex items-center p-3 rounded-lg  bg-dark-blue-500 border border-theme-500  cursor-pointer">
        <UIcon name="heroicons-solid:calendar" class="w-10 h-10  bg-theme-500" />
        <p class=" mx-4 text-2xl  text-theme-500">Dates</p>
    </button>
</div>

    <transition name="slide">
      <NavigationDatePicker v-if="isDateOpen" @close="closeDates"  />
      
    </transition>
  

</template>

<script setup>

import { ref } from 'vue';


const isDateOpen = ref(false);

const toggleDates = () => {
    isDateOpen.value = !isDateOpen.value;
};

const closeDates = () => {
    isDateOpen.value = false;
};


</script>

