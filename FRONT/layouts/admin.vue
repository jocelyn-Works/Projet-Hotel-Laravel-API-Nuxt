<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#183456] text-white p-4 flex flex-col">
      <h2 class="text-center text-2xl font-bold mb-6">Admin Panel</h2>
      <nav>
        <ul>
          <li class="mb-4">
            <a href="#" class="block p-2 rounded hover:bg-white hover:text-[#183456]">Dashboard</a>
          </li>
          <li class="mb-4">
            <a href="#" class="block p-2 rounded hover:bg-white hover:text-[#183456]">Utilisateurs</a>
          </li>
          <li class="mb-4">
            <a href="#" class="block p-2 rounded hover:bg-white hover:text-[#183456]">Paramètres</a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow-md p-4 text-center text-xl font-semibold">
        <img src="/logo.png" alt="Logo" class="mx-auto h-12">
      </header>

      <!-- Contenu -->
      <main class="p-6 flex-1">
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminLayout"
};
</script>