<template>
                                        
<button  @click="openLogin" class="flex items-center p-1 rounded-lg  bg-theme-500 text-dark-blue-500 border border-theme-500 hover:bg-dark-blue-500 hover:text-theme-500 cursor-pointer">
    <UIcon name="line-md:account" class="w-10 h-10" />
    <p class=" mx-4 text-2xl ">connexion</p>
</button>





</template>

<script setup>

import { useUiStore } from '~/stores/ui';

const uiStore = useUiStore();

const openLogin = () => {
  uiStore.setActiveComponent('login');
};


</script>