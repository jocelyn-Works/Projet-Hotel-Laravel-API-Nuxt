<template>
  <header class="relative">
    <!-- Image header -->
    <div v-if="data && data.length > 0" class=" h-[700px] md:h-[500px] lg:h-[700px] flex justify-center items-center">
  <img :src="data[0].image_url" class="w-full h-full  clipPath" alt="Image de l'hôtel" />
</div>

    <!-- logo -->
    <div
      v-if="dataHotel && dataHotel.length > 0"
      class="absolute top-4 left-1/2 transform -translate-x-1/2"
    >
      <img :src="dataHotel[0].image_url" alt="Hotel Logo" class="w-36 h-36 object-contain">
    </div>

     <!-- header -->
    <div class="flex flex-wrap items-center justify-center  p-8 relative">
      <p
        v-if="data && data.length > 0"
        class="satisfy text-dark-blue-500 font-bold text-4xl md:text-5xl lg:text-6xl text-center"
      >
        {{ data[0].content }}
      </p>
    </div>
  </header>
</template>

<script setup>
const apiUrl = import.meta.env.VITE_API_URL;

// header
const { data } = await useFetch(`${apiUrl}/header/all`);

// hôtel
const { data: dataHotel } = await useFetch(`${apiUrl}/home/hotel`);
</script>

<style scoped>
.satisfy {
  font-family: 'Satisfy', cursive;
}

.clipPath{
  clip-path: ellipse(90% 100% at 50% 0%);
}


</style>
