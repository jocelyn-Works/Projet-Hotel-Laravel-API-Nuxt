<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

definePageMeta({
  layout: "admin"
});

const hotelData = ref({});
const mainData = ref([]);
const headerData = ref({});
const socialData = ref({});
const hotelId = ref(null);

// ✅ Charger toutes les données depuis l'API
async function fetchData() {
  try {
    // Charger l'hôtel
    const hotelResponse = await fetch("http://127.0.0.1:8000/api/home/hotel");
    const hotelResult = await hotelResponse.json();
    if (hotelResult.length > 0) {
      hotelData.value = { ...hotelResult[0] };
      hotelId.value = hotelResult[0].id;
    }

    // Charger le main
    const mainResponse = await fetch("http://127.0.0.1:8000/api/home/main");
    const mainResult = await mainResponse.json();
    if (mainResult.length > 0) {
      mainData.value = mainResult; // 🔥 Stocke tous les éléments de Main
    }

    // Charger le header
    const headerResponse = await fetch("http://127.0.0.1:8000/api/home/header");
    const headerResult = await headerResponse.json();
    if (headerResult.length > 0) {
      headerData.value = { ...headerResult[0] };
    }

    // Charger le social
    const socialResponse = await fetch("http://127.0.0.1:8000/api/home/social");
    const socialResult = await socialResponse.json();
    if (socialResult.length > 0) {
      socialData.value = { ...socialResult[0] };
    }

    // 🔥 DEBUG : Affiche les données récupérées dans la console
    console.log("Données récupérées :", {
      hotelData: JSON.parse(JSON.stringify(hotelData.value)),
      mainData: JSON.parse(JSON.stringify(mainData.value)),
      headerData: JSON.parse(JSON.stringify(headerData.value)),
      socialData: JSON.parse(JSON.stringify(socialData.value))
    });

  } catch (error) {
    console.error("Erreur lors du chargement des données :", error);
  }
}

onMounted(fetchData);
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Mise à jour du site</h1>

    <!-- 🔹 Modifier l'Hôtel -->
    <div v-if="hotelId" class="mb-8">
      <h2 class="text-xl font-semibold mb-2">Modifier l'Hôtel</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <UpdateField label="Nom de l'hôtel" api-field="name" :url="`http://127.0.0.1:8000/api/home/updateHotel/${hotelId}`" v-model="hotelData.name" />
        <UpdateField label="Adresse" api-field="street" :url="`http://127.0.0.1:8000/api/home/updateHotel/${hotelId}`" v-model="hotelData.street" />
        <UpdateField label="Ville" api-field="city" :url="`http://127.0.0.1:8000/api/home/updateHotel/${hotelId}`" v-model="hotelData.city" />
        <UpdateField label="Téléphone" api-field="phone_number" :url="`http://127.0.0.1:8000/api/home/updateHotel/${hotelId}`" v-model="hotelData.phone_number" />
        <UpdateField label="Email" api-field="email" :url="`http://127.0.0.1:8000/api/home/updateHotel/${hotelId}`" v-model="hotelData.email" />
        <UpdateField label="Logo de l'hôtel" api-field="image" type="file" :url="`http://127.0.0.1:8000/api/home/updateHotel/${hotelId}`" />
      </div>
    </div>

    <!-- 🔹 Modifier le Header -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2">Modifier le Header</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <UpdateField label="Contenu" api-field="content" :url="`http://127.0.0.1:8000/api/home/updateHeader/1`" v-model="headerData.content" />
        <UpdateField label="Image du Header" api-field="image" type="file" :url="`http://127.0.0.1:8000/api/home/updateHeader/1`" />
      </div>
    </div>

    <!-- 🔹 Modifier la section Main -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2">Modifier la section Main</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <template v-for="main in mainData" :key="main.id">
          <UpdateField
              :label="`Contenu ${main.id}`"
              api-field="content"
              :url="`http://127.0.0.1:8000/api/home/updateMain/${main.id}`"
              v-model="main.content"
          />
          <UpdateField
              :label="`Image ${main.id}`"
              api-field="image"
              type="file"
              :url="`http://127.0.0.1:8000/api/home/updateMain/${main.id}`"
          />
        </template>
      </div>
    </div>

    <!-- 🔹 Modifier les Réseaux Sociaux -->
    <div>
      <h2 class="text-xl font-semibold mb-2">Modifier les Réseaux Sociaux</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <UpdateField label="Lien du Réseau Social" api-field="url" :url="`http://127.0.0.1:8000/api/home/updateSocial/1`" v-model="socialData.url" />
      </div>
    </div>
  </div>
</template>