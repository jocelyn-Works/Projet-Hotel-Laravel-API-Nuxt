<template>

  <header class="relative">
    <!-- Image header -->
    <div v-for="(header) in dataHeader" :key="header.id" class=" h-[700px] md:h-[500px] lg:h-[700px] flex justify-center items-center">
      <img :src="header.image_url" class="w-full h-full  clipPath" alt="Image de l'hôtel" />
    </div>

    <!-- Superposition ponctuelle uniquement ici -->
    <Logo class="absolute top-4 left-1/2 -translate-x-1/2 z-20"/>
    <ButtonDate />

    <!-- logo -->
<!--    <div-->
<!--      v-for="(hotel) in dataHotel ":key="hotel.id"-->
<!--      class="absolute top-4 left-1/2 transform -translate-x-1/2"-->
<!--    >-->
<!--      <img :src="hotel.image_url" alt="Hotel Logo" class="w-36 h-36 object-contain">-->
<!--    </div>-->

     <!-- header -->
    <div class="flex flex-wrap items-center justify-center  p-8 relative">
      <p
        v-for="(header) in dataHeader" :key="header.id"
        class="satisfy text-dark-blue-500 font-bold text-4xl md:text-5xl lg:text-6xl text-center"
      >
        {{ header.content }}
      </p>
    </div>
  </header>
  

</template>

<script setup>
const apiUrl = import.meta.env.VITE_API_URL;

// header
const { data: dataHeader } = await useFetch(`${apiUrl}/header/all`);

// // hôtel
// const { data: dataHotel } = await useFetch(`${apiUrl}/hotel/all`);

</script>

<style scoped>


.clipPath{
  clip-path: ellipse(90% 100% at 50% 0%);
}


</style>
