<template>
  <aside
      class="w-64 bg-[#183456] text-white p-4 fixed top-20 left-0 h-[calc(100vh-80px)] overflow-y-auto rounded-tr-[30px] shadow-lg flex flex-col"
  >
    <h2 class="text-center text-2xl font-bold mb-6">Dashboard</h2>

    <nav>
      <ul>
        <li v-for="item in menuItems" :key="item.name" class="mb-4">
          <NuxtLink
              :to="item.link"
              class="block p-2 rounded hover:bg-white hover:text-[#183456]"
          >
            {{ item.name }}
          </NuxtLink>
        </li>
      </ul>
    </nav>

    <!-- 🔹 Bouton Voir le site -->
    <button
        @click="redirectToSite"
        class="mt-auto bg-white text-gold-500 px-4 py-2 rounded hover:bg-gold-500 transition hover:text-white"
    >
      Voir le site
    </button>
  </aside>
</template>

<script setup>
const menuItems = [
  { name: "Accueil", link: "/admin" },
  { name: "Mise à jour du site", link: "/admin/update-website" },
];

// 🔥 Ouvre le site dans un nouvel onglet
const redirectToSite = () => {
  window.open("http://localhost:3000", "_blank"); // 🔥 Nouvelle fenêtre
};
</script>