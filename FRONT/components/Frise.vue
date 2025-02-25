<script setup lang="ts">
  defineProps({
    src: {
      type: String,
      required: true
    }
  })

</script>

<template>
  <div class="flex justify-center items-center w-full p-2">
    <img :src="src" alt="Frise" class="max-w-full m-4"/>
  </div>
</template>
