<template>
  <header>
    <div v-if="data && data.length > 0" class="h-[800px] bg-cover bg-center" :style="{ backgroundImage: `url(${data[0].image_url})` }">
      
    </div>
    <div class="flex flex-wrap items-center justify-center">
        <p class=" p-8 text-white text-4xl ">{{ data[0].content }}</p>
      </div>
  </header>
</template>

<script setup>
const { data } = await useFetch('http://127.0.0.1:8000/api/home/header')
</script>