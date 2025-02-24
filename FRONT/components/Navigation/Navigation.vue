<template>
    <nav class="fixed top-0 left-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-br-lg z-10">
      <div class="flex justify-between bg-dark-blue-500 p-4">
        <button>Connexion</button>
        <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeNavigation" />
      </div>
      <div class="p-6 satisfy text-dark-blue-500">
        <ul class="text-2xl p-5">
            <li>Mes reservations</li>
            <li>Chambres et suites</li>
            <li>Bars et Restaurants</li>
        </ul>
      </div>
      <AppFooter />
    </nav>
  </template>
  
  <script setup>
  import { defineEmits } from 'vue';
  
  const emit = defineEmits(['close']);
  
  const closeNavigation = () => {
    emit('close');
  };
  </script>

    <style>
        .satisfy {
        font-family: 'Satisfy', cursive;
        }
        
    </style>
  