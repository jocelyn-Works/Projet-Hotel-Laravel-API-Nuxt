<template>
<!--  <nav>-->
<!--    <NuxtLink to="/">Accueil</NuxtLink>-->
<!--    <NuxtLink to="/booking">Booking</NuxtLink>-->
<!--  </nav>-->
  <header class="app-header">

    <!-- Image de fond -->
    <div class="background-image"></div>

    <!-- Logo -->
    <div class="logo">
      <img src="../public/ImagesHomepage/logo.png" alt="Hotel Logo" />
    </div>


  </header>
</template>



<style scoped>
.app-header {
  position: relative;
  width: 100%;
  height: 800px;
  display: flex;
  justify-content: center;
  overflow: hidden;
}

/* Image de fond */
.background-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('../public/ImagesHomepage/hotel-luxe.png');
  background-size: cover;
  background-position: center;
  z-index: -1;
}

</style>
<script setup lang="ts">
</script>