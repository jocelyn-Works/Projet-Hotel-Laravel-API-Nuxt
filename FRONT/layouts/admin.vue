<!--
===================================================
Guide pour ajouter une nouvelle page au dashboard
===================================================

1️⃣ **Créer un nouveau fichier de page**
   - Dans le dossier `pages/admin/`, crée un nouveau fichier `.vue`
   - Exemple : `pages/admin/nouvelle-page.vue`

2️⃣ **Définir le layout du dashboard**
   - Dans le fichier de la nouvelle page, ajoute en haut :
     ```vue
     <script setup>
     definePageMeta({
       layout: 'admin'
     });
     </script>
     ```
   - Cela permet d'utiliser la structure du dashboard (`admin.vue`).

3️⃣ **Ajouter un lien dans la sidebar**
   - Ouvre `Sidebar.vue` et ajoute un nouvel élément dans `menuItems` :
     ```vue
     const menuItems = [
       { name: "Dashboard", link: "/admin" },
       { name: "Mise à jour du site", link: "/admin/update-website" },
       { name: "Nouvelle Page", link: "/admin/nouvelle-page" }
     ];
     ```

4️⃣ **Sauvegarder et tester**
   - Recharge la page.
   - Le lien de la nouvelle page devrait apparaître dans la sidebar et être accessible.

**C'est tout ! La nouvelle page est maintenant intégrée au dashboard !**

-->

<template>
  <div class="min-h-screen bg-[#F9F9F6] flex">
    <!-- Sidebar -->
    <Sidebar class="w-64" />

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="flex justify-center items-center pt-6 ml-64 relative">
        <Logo class="absolute top-4 left-1/2 transform -translate-x-1/2 z-50" />
      </header>

      <!-- Contenu dynamique -->
      <main class="p-6 flex-1 ml-64 mt-24"> <!-- Ajoute mt-24 (ou plus) ici -->
        <NuxtPage />
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from '@/components/dashboard/Sidebar.vue'

definePageMeta({
  middleware: 'auth-admin'
});
</script>