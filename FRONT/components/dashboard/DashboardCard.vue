<template>
  <div class="bg-white p-6 rounded-lg shadow-md text-center">
    <h2 class="text-lg font-semibold">{{ title }}</h2>
    <p class="text-2xl font-bold text-blue-500">{{ value }}</p>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  value: Number
});
</script>