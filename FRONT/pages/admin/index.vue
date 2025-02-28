<script setup>
import DashboardCard from '@/components/dashboard/DashboardCard.vue';

definePageMeta({
  layout: 'admin'
});
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