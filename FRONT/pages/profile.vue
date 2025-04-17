<template>
  <div class="profile-container">

      <h1 class="title font-semibold mb-2">Profil Utilisateur</h1>
      <div v-if="user" class="user-card bg-white p-4 rounded shadow mb-8">

          <div class="info-item">
            <strong>Nom :</strong> {{ user.first_name }} {{ user.last_name }}
          </div>
          <div class="info-item">
            <strong>Email :</strong> {{ user.email }}
          </div>
          <div class="info-item">
            <strong>Téléphone :</strong> {{ user.phone }}
          </div>
          <div class="info-item">
            <strong>Adresse :</strong> {{ user.address }}
          </div>

      </div>
      <div v-else class="loading">
        <p>Chargement du profil...</p>
      </div>

  </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';



const userStore = useUserStore();
const user = computed(() => userStore.user);

onMounted(async () => {
  await userStore.fetchUser();
});
</script>

<style scoped>
.profile-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  text-align: center;
}

.user-info, .loading {
  margin-top: 20px;
}

.title {
  font-size: 2em;
  margin-bottom: 1em;
}

.info-item {
  margin: 0.5em 0;
  font-size: 1.2em;
}
</style>