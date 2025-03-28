<template>



    <ButtonAppMenu />


  <main class="bg-theme-500 ">
    <NuxtPage />
  </main>
  <AppFooter />

  <transition name="slide">
    <Navigation v-if="activeComponent === 'navigation'" />
  </transition>

  <transition name="slide">
    <NavigationLogin v-if="activeComponent === 'login'" />
  </transition>

  <transition name="slide">
    <NavigationDatePicker v-if="activeComponent === 'dates'"  />
  </transition>

  <transition name="slide">
    <NavigationSignup v-if="activeComponent === 'signup'"  />
  </transition>

  <transition name="slide">
    <NavigationService v-if="activeComponent === 'service'" />
  </transition>

</template>

<script setup>
const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);
</script>

