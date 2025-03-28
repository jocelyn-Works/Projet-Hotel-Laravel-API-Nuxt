<template>
  <section class="nav fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">
    <div class="flex w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeService" />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Service</h2>
    </div>

    <div class="flex flex-row flex-wrap w-full p-2">

      <p v-if="serviceStore.loading">Chargement...</p>
      <p v-if="serviceStore.error" class="error">{{ serviceStore.error }}</p>
      <div v-if="!serviceStore.loading && !serviceStore.error">

        <div v-for="service in serviceStore.services" :key="service.id" class=" m-2">

         <div class="p-4 border border-gold-500 cursor-pointer bg-dark-blue-400 text-white rounded-xl text-center text-base sm:text-xl
              transition-all duration-300 ease-in-out transform hover:bg-dark-blue-300 hover:-translate-y-1 hover:shadow-lg
              active:translate-y-0 active:shadow-md">
           <span>
             {{ service.name }}
           </span>

         </div>

        </div>
      </div>
      <p v-if="!serviceStore.services.length && !serviceStore.loading">Aucun service disponible.</p>

    </div>

    <div class="w-full flex justify-around items-center mt-4 p-4">
      <button class="">
        vfv
      </button>
      <button class="">
        fvfv
      </button>
    </div>

  </section>
</template>

<script setup lang="ts">
// appel service pinia
const serviceStore = useServiceStore();

onMounted(() => {
  serviceStore.fetchServices();
});
const uiStore = useUiStore();

// géré le composant / fermeture
const closeService = () => {
  uiStore.closeComponent();
};

</script >

<style scoped>

</style>
