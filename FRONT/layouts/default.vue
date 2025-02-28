<template>
  <ButtonAppMenu />
  <main class="bg-theme-500">

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


</template>

<script setup>

import { storeToRefs } from 'pinia';
import { useUiStore } from '~/stores/ui';


const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);
</script>

