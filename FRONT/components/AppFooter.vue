<template>
    <footer class="bg-dark-blue-500 p-2">
    <div>{{ data }}</div>

</footer>
</template>

<script setup>
const apiUrl = import.meta.env.VITE_API_URL;
const data = await useFetch( `${apiUrl}/home/social`)
</script>