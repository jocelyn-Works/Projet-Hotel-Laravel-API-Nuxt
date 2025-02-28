<script setup >
import { storeToRefs } from 'pinia';
import { useUiStore } from '~/stores/ui';


const uiStore = useUiStore();
const { activeComponent } = storeToRefs(uiStore);

</script>

<template>
  <BookingAppCart />
  

  <transition name="slide">
    <NavigationCart v-if="activeComponent === 'cart'" />
  </transition>
  
  
</template>