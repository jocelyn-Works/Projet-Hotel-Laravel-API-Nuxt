<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

const usersData = ref([]);

async function fetchUsers() {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/user/all");
    const data = await response.json();
      usersData.value = data;

  } catch (error) {
    console.error("Erreur lors du chargement des utilisateurs:", error);
  }
}

onMounted(fetchUsers);
</script>

<template>
  <div>
    <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier les Utilisateurs</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <template
          v-for="user in usersData"
          :key="user.id"
          class="user-card bg-white p-4 rounded shadow mb-8"

      >
        <UpdateField
            label="Prénom"
            api-field="first_name"
            :url="`http://127.0.0.1:8000/api/user/update/${user.id}`"
            v-model="user.first_name"
            class="mb-6"
        />
        <UpdateField
            label="Nom"
            api-field="last_name"
            :url="`http://127.0.0.1:8000/api/user/update/${user.id}`"
            v-model="user.last_name"
            class="mb-6"
        />
        <UpdateField
            label="Email"
            api-field="email"
            :url="`http://127.0.0.1:8000/api/user/update/${user.id}`"
            v-model="user.email"
            class="mb-6"
        />
        <UpdateField
            label="Téléphone"
            api-field="phone"
            :url="`http://127.0.0.1:8000/api/user/update/${user.id}`"
            v-model="user.phone"
            class="mb-6"
        />
        <UpdateField
            label="Adresse"
            api-field="address"
            :url="`http://127.0.0.1:8000/api/user/update/${user.id}`"
            v-model="user.address"
            class="mb-6"
        />
        <UpdateField
            label="Admin"
            api-field="is_admin"
            :url="`http://127.0.0.1:8000/api/user/update/${user.id}`"
            v-model="user.is_admin"
            class="mb-6"
        />
      </template>
    </div>
  </div>
</template>


<style scoped>
.user-card {
  margin-bottom: 4rem; /* Espace entre les utilisateurs */
}

.mb-6 {
  margin-bottom: 2rem; /* Espace entre les champs d'un même utilisateur */
}
</style>