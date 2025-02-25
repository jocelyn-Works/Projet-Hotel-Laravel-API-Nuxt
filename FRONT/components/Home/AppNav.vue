<template>
 
    <nav class="fixed top-0 left-0 ml-6 mt-8 z-10 rounded bg-dark-blue-500 bg-opacity-80">
      <div class="flex items-center justify-center w-14 h-14 p-2" @click="toggleNavigation">
        <UIcon name="proicons:text-description" class="w-full h-full cursor-pointer" />
      </div>
    </nav>

    <transition name="slide">
      <Navigation v-if="isNavigationOpen" @close="closeNavigation" />
    </transition>
  
</template>

<script setup>
import { ref } from 'vue';


const isNavigationOpen = ref(false);

const toggleNavigation = () => {
  isNavigationOpen.value = !isNavigationOpen.value;
};

const closeNavigation = () => {
  isNavigationOpen.value = false;
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
