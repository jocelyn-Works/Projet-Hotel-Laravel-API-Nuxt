<template>

    <section class="fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">

      <div class="flex items-center w-full bg-dark-blue-500 p-4">
        <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeDates" />
        <h2 class="text-theme-500 text-3xl satisfy flex-grow text-center">Dates</h2>
      </div>
      <div class="w-full h-full">

        
      </div>

      


    </section>

  </template>

<script setup>

// btn close 

const emit = defineEmits(['close']);
  
  const closeDates = () => {
    emit('close');
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

  