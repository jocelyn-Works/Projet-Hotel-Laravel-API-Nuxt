<template>

  <HomeAppHeader />
  <Frise src="/ImagesHomepage/frise.svg" />
  <HomePresentation />
  <RoomTypes />
</template>

<script setup>
  import Frise from "~/components/Frise.vue";
  import HomePresentation from "~/components/Home/HomePresentation.vue";
  import RoomTypes from "~/components/Home/RoomTypes.vue";
</script>
