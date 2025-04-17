<template>
  <nav class="nav fixed top-0 left-0 w-full md:w-2/5  border border-dark-blue-500 rounded-br-lg z-10">
    <div class="flex justify-between items-center bg-dark-blue-500 p-4">
      <div v-if="user">
        <ButtonLogout />
      </div>
      <div v-else>
        <ButtonLogin />
      </div>
      <div v-if="user" class=" flex flex-row items-center text-white dark:text-theme-500">
        <span className="relative w-2 h-2 rounded-full bg-green-400 m-2">
          <span className="absolute inset-0 w-2 h-2 rounded-full bg-green-400 animate-ping"></span>
        </span>
        <p class="text-1xl"> {{ user.first_name }} {{ user.last_name}} </p>
      </div>
      <ButtonDarkMode />
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeNavigation" />
    </div>
    <div class="p-6 satisfy text-dark-blue-500 ">
      <ul class="text-2xl p-5 m-3">
        <li>
          <NuxtLink to="/" >Accueil</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/my-bookings">Mes réservations</NuxtLink>
        </li>
        <li>Chambres et suites</li>
        <li>Bars et Restaurants</li>
        <li v-if="user && user.is_admin" >
          <NuxtLink to="/admin" >Administration</NuxtLink>
        </li>
        <li v-if="user">
          <NuxtLink to="/profile">Profile</NuxtLink>
        </li>
      </ul>
    </div>
    <AppFooter class="rounded-br-[7px]" />
  </nav>
</template>

<script setup lang="ts">



const uiStore = useUiStore();
const userStore = useUserStore();

onMounted(async () => {
  await userStore.fetchUser();
});

const user = computed(() => userStore.user);


const logout = () => {
  userStore.logout();
  // Rediriger l'utilisateur vers la page de connexion ou d'accueil après la déconnexion
  // navigateTo('/login');
};

</script>

<style scoped>
/* Transition styles */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.4s ease;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateX(-100%);
}

.slide-enter-to,
.slide-leave-from {
  transform: translateX(0);
}
</style>

