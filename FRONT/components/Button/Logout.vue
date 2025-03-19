<template>
    <button @click="logout" class="flex items-center p-1 rounded-lg bg-theme-500 text-dark-blue-500 border border-theme-500 hover:bg-dark-blue-500 hover:text-theme-500 cursor-pointer">
      <UIcon name="mdi:power-settings" class="w-10 h-10" />
      <p class="mx-4 text-2xl">Déconnexion</p>
    </button>
  </template>
  
  <script setup lang="ts">
  import { useUserStore } from '~/stores/user';
  import { useFetch } from 'nuxt/app';
  
  const userStore = useUserStore();
  
  const logout = async () => {
    const apiUrl = import.meta.env.VITE_API_URL;
  
    // Envoyer une requête POST à la route de déconnexion
    const { error } = await useFetch(`${apiUrl}/connexion/logout`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${userStore.token}`,
      },
    });
  
    if (!error.value) {
      // Mettre à jour le store pour refléter la déconnexion
      userStore.logout();
      // Rediriger l'utilisateur vers une autre page si nécessaire
      // navigateTo('/login');
    } else {
      console.error('Erreur lors de la déconnexion :', error.value);
    }
  };
  </script>
  