<template>
  <header>
    <div
      v-if="data && data.length > 0"
      class="h-[700px] md:h-[500px] lg:h-[700px] bg-cover bg-center"
      :style="{ backgroundImage: `url(${data[0].image_url})` }"
    ></div>
    <div class="flex flex-wrap items-center justify-center m-4 p-8">
      <p
        class="satisfy text-dark-blue-500 font-bold text-4xl md:text-5xl lg:text-6xl text-center"
      >
        {{ data[0].content }}
      </p>
    </div>
  </header>
</template>

<script setup>
const apiUrl = import.meta.env.VITE_API_URL;
const { data } = await useFetch(`${apiUrl}/home/header`);
</script>

<style scoped>
.satisfy {
  font-family: 'Satisfy', cursive;
}
</style>
