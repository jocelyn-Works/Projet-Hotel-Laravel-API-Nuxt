<template>
  <transition name="slide">
  <section class=" nav fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">
    <div class="flex items-center w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeLogin" />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Connexion</h2>
    </div>

    <div class="flex justify-center w-full p-10">
      <form @submit.prevent="loginUser">
        <div class="form-control">
          <input type="email" name="email" id="email" v-model="user.email" required>
          <label for="email"> Email </label>
        </div>

        <div class="form-control">
          <input type="password" name="password" id="password" v-model="user.password" required>
          <label for="password"> Mot de Passe </label>
        </div>

        <div class="flex justify-center">
          <UButton
            type="submit"
            class="bg-dark-blue-400 !text-white !text-2xl !px-4 !py-2"
            variant="solid"
            size="md"
          >
            Connexion
          </UButton>
        </div>
      </form>

      <!-- Affichage des messages d'erreur -->
    </div>
    <div v-if="errorMessage" class="flex justify-center items-center text-red-500 mt-4">
      {{ errorMessage }}
    </div>
    <div v-if="successMessage" class="flex justify-center items-center text-green-500 mt-4">
      {{ successMessage }}
    </div>

    <ButtonSignup />
  </section>
</transition>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useUiStore } from '~/stores/ui';
import { useFetch } from 'nuxt/app';

const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl;

const uiStore = useUiStore();
const user = ref({
  email: '',
  password: ''
});
const errorMessage = ref('');
const successMessage = ref('');

const loginUser = async () => {
  const { data, error } = await useFetch(`${apiUrl}/connexion/login`, {
    method: 'POST',
    body: user.value
  });

  if (data.value && data.value.status === 'success') {
    // Stocker le token d'authentification
    localStorage.setItem('authToken', data.value.data.token);
    
    successMessage.value = 'Connecté !!';
  
    window.location.reload(); // actualise la page
    // Fermer  après 5 secondes
    setTimeout(() => {
      setTimeout(() => {
      closeLogin();
    }, 3000);;
    }, 5000);
  }

  if (error.value) {
    // Gérer les erreurs ici
    errorMessage.value = 'Une erreur est survenue lors de la connexion. Veuillez réessayer.';
  }
};

onMounted(() => {
  const labels = document.querySelectorAll(".form-control label");

  labels.forEach((label) => {
    label.innerHTML = label.innerText
      .split("")
      .map((letter, idx) =>
        `<span style="transition-delay:${idx * 50}ms">${letter}</span>`
      )
      .join("");
  });
});

const closeLogin = () => {
  uiStore.closeComponent();
};
</script>

<style scoped>

</style>
