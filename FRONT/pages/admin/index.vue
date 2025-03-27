<script setup>
import DashboardCard from '@/components/dashboard/DashboardCard.vue';

definePageMeta({
  layout: 'admin'
});

//definePageMeta({
  //middleware: async (to, from) => {
    //const userStore = useUserStore();

    // Vérifiez si l'utilisateur est un administrateur
    //if (to.path === '/admin' && (!userStore.user || !userStore.user.is_admin)) {
      //return navigateTo('/'); // Redirige vers la page d'accueil ou une page d'erreur
   // }
  //}
//});
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold my-6 text-center">Tableau de bord</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <DashboardCard title="Réservations" :value="15" />
      <DashboardCard title="Chambres disponibles" :value="5" />
    </div>
  </div>
</template>