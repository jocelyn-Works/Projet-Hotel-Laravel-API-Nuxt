<template>

    <div class="flex justify-center items-center text-dark-blue-500 p-3">
        <p>Vous n'avez pas de compte ?</p>
        <p @click="openSignup" class=" mx-4 text-2xl hover:text-gold-300  cursor-pointer ">inscrivez-vous</p>
    </div>
    
    
    </template>
    
    <script setup>
    
    import { useUiStore } from '~/stores/ui';
    
    const uiStore = useUiStore();
    
    const openSignup = () => {
      uiStore.setActiveComponent('inscription');
    };
    
    
    </script>