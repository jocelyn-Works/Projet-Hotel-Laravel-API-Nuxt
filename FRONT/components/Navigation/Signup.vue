<template>
  <section class="nav fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">
    <div class="flex items-center w-full bg-dark-blue-500 p-3">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeSignup" />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Inscription</h2>
    </div>

    <div class="flex justify-center w-full p-4">
      <form @submit.prevent="registerUser">

        <div class="form-control">
          <input type="text" name="firstName" id="firstName" v-model="user.first_name" required>
          <label for="firstName"> Prénom </label>
        </div>

        <div class="form-control">
          <input type="text" name="lastnName" id="lastName" v-model="user.last_name" required>
          <label for="name"> Nom </label>
        </div>

        <div class="form-control">
          <input type="text" name="phone" id="phone" v-model="user.phone" required>
          <label for="phone"> Telephone </label>
        </div>

        <div class="form-control">
          <input type="text" name="adress" id="adress" v-model="user.address" required>
          <label for="adress"> Adresse </label>
        </div>

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
            class="bg-dark-blue-400 !text-white !text-2xl !px-4 "
            variant="solid"
            size="md"
          >
            Enregistrer
          </UButton>
        </div>
      </form>
    </div>

    <!-- Affichage des messages d'erreur -->
    <div v-if="errorMessage" class="flex justify-center items-center text-red-500 mt-4">
      {{ errorMessage }}
    </div>
    <div v-if="successMessage" class="flex justify-center items-center text-green-500 mt-4">
      {{ successMessage }}
    </div>

    <div class="flex justify-center items-center text-dark-blue-500 p-3">
      <p>Deja un compte ?</p>
      <p @click="openLogin" class="mx-4 text-2xl hover:text-gold-300 cursor-pointer">connexion</p>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useUiStore } from '~/stores/ui';
import { useFetch } from 'nuxt/app';

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

const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl;
const uiStore = useUiStore();
const user = ref({
  last_name: '',
  first_name: '',
  phone: '',
  address: '',
  email: '',
  password: ''
});
const errorMessage = ref('');
const successMessage = ref('');

const registerUser = async () => {
  const { data, error } = await useFetch(`${apiUrl}/connexion/register`, {
    method: 'POST',
    body: user.value
  });

  // conexion apres inscription
  if (data.value && data.value.status === 'success') {
    
    const { data: loginData, error: loginError } = await useFetch(`${apiUrl}/connexion/login`, {
      method: 'POST',
      body: {
        email: user.value.email,
        password: user.value.password
      }
    });

    if (loginData.value && loginData.value.status === 'success') {
      // Stocker le token d'authentification
      localStorage.setItem('authToken', loginData.value.data.token);
      // Afficher un message de succès
      successMessage.value = 'Inscription réussie et connecté !';
      // Réinitialiser le formulaire
      user.value = {
        last_name: '',
        first_name: '',
        phone: '',
        address: '',
        email: '',
        password: ''
      };

      window.location.reload();
    // Fermer le composant après 3 secondes
    setTimeout(() => {
      uiStore.closeComponent();
    }, 4000);
      // Rediriger l'utilisateur vers une autre page si nécessaire
      // Par exemple : navigateTo('/dashboard');
    } else {
      errorMessage.value = 'Erreur lors de la connexion automatique. Veuillez réessayer.';
    }
  }

  if (error.value) {
    errorMessage.value = 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.';
  }
};

const closeSignup = () => {
  uiStore.closeComponent();
};

const openLogin = () => {
  uiStore.setActiveComponent('login');
};
</script>

<style scoped>

</style>
