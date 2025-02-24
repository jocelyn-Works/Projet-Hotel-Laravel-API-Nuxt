<template>
  <div>
    <!-- Bouton Burger -->
    <UButton
        icon="i-heroicons-bars-3"
        variant="ghost"
        @click="isSidebarOpen = true"
        class="fixed top-4 left-4 z-50"
    />

    <!-- Sidebar avec USlideover depuis la gauche -->
    <USlideover v-model="isSidebarOpen" side="left" class="mt-28">
      <div class="p-4 flex-1 bg-dark-blue h-full w-80" >
        <!-- Bouton de fermeture -->
        <UButton
            color="gray"
            variant="ghost"
            size="sm"
            icon="i-heroicons-x-mark-20-solid"
            class="absolute right-5 top-5 z-10"
            square
            @click="isSidebarOpen = false"
        />

        <!-- Contenu de la Sidebar -->
        <nav class="mt-10">
          <h2 class="text-xl font-bold mb-4">Gestion du site</h2>

          <ul class="flex flex-col gap-2">
            <li v-for="(item, index) in menuItems" :key="index">
              <NuxtLink
                  :to="item.link"
                  class="block px-4 py-2 rounded hover:bg-gray-200"
                  @click="$emit('close')"
              >
                {{ item.name }}
              </NuxtLink>
            </li>
          </ul>
        </nav>
      </div>
    </USlideover>
  </div>
</template>

<script setup>
import { ref } from "vue";

const isSidebarOpen = ref(false);

const menuItems = [
  { name: "Accueil", link: "/admin" },
  { name: "Mise à jour du site", link: "/admin/update-website" },
  // { name: "Utilisateurs", link: "/admin/users" },
  // { name: "Réservations", link: "/admin/bookings" },
  // { name: "Chambres", link: "/admin/rooms" },
  // { name: "Déconnexion", link: "/logout" },
];
</script>

