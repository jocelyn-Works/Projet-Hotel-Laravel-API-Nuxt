<template>
  <div class="flex flex-col min-h-screen bg-theme-500">
    <ButtonAppMenu />

    <!-- Contenu principal -->
    <main class="flex-1">
      <NuxtPage />
    </main>

    <!-- Footer -->
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

  </div>
</template>

<script setup>

import { storeToRefs } from 'pinia';
import { useUiStore } from '~/stores/ui';


const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);
</script>

