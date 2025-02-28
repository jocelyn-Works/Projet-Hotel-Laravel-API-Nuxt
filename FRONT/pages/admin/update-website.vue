<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

definePageMeta({
  layout: "admin"
});

const apiURL = import.meta.env.apiURL;

const hotelData = ref({});
const mainData = ref([]);
const headerData = ref({});
const socialData = ref([]);
const roomTypes = ref([]);
const hotelId = ref(null);

// Charger toutes les données depuis l'API
async function fetchData() {
  try {
    // Charger l'hôtel
    const hotelResponse = await fetch("http://127.0.0.1:8000/api/hotel/all");
    const hotelResult = await hotelResponse.json();
    if (hotelResult.length > 0) {
      hotelData.value = { ...hotelResult[0] };
      hotelId.value = hotelResult[0].id;
    }

    // Charger le main
    const mainResponse = await fetch("http://127.0.0.1:8000/api/main/all");
    const mainResult = await mainResponse.json();
    if (mainResult.length > 0) {
      mainData.value = mainResult; // Stocke tous les éléments de Main
    }

    // Charger le header
    const headerResponse = await fetch("http://127.0.0.1:8000/api/header/all");
    const headerResult = await headerResponse.json();
    if (headerResult.length > 0) {
      headerData.value = { ...headerResult[0] };
    }

    // Charger les réseaux sociaux
    const socialResponse = await fetch("http://127.0.0.1:8000/api/social/all");
    const socialResult = await socialResponse.json();
    if (socialResult.length > 0) {
      socialData.value = socialResult; // Stocke tous les réseaux sociaux sous forme de tableau
    }

    // Charger les types de chambre
    const roomResponse = await fetch("http://127.0.0.1:8000/api/type/all");
    const roomResult = await roomResponse.json();
    roomTypes.value = roomResult;

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
    <h1 class="text-2xl font-bold my-6 text-center ">Mise à jour du site</h1>

    <!-- 🔹 Modifier l'Hôtel -->
    <div v-if="hotelId" class="mb-8">
      <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier l'Hôtel</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <UpdateField label="Nom de l'hôtel" api-field="name" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.name" />
        <UpdateField label="Adresse" api-field="street" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.street" />
        <UpdateField label="Ville" api-field="city" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.city" />
        <UpdateField label="Téléphone" api-field="phone_number" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.phone_number" />
        <UpdateField label="Email" api-field="email" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.email" />
        <UpdateField label="Logo de l'hôtel" api-field="image" type="file" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" />
      </div>
    </div>

    <!-- 🔹 Modifier le Header -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier le Header</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <UpdateField label="Contenu" api-field="content" :url="`http://127.0.0.1:8000/api/header/update/1`" v-model="headerData.content" />
        <UpdateField label="Image du Header" api-field="image" type="file" :url="`http://127.0.0.1:8000/api/header/update/1`" />
      </div>
    </div>

    <!-- 🔹 Modifier la section Main -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier la section Main</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <template v-for="main in mainData" :key="main.id">
          <UpdateField
              :label="`Contenu ${main.id}`"
              api-field="content"
              :url="`http://127.0.0.1:8000/api/main/update/${main.id}`"
              v-model="main.content"
          />
          <UpdateField
              :label="`Image ${main.id}`"
              api-field="image"
              type="file"
              :url="`http://127.0.0.1:8000/api/main/update/${main.id}`"
          />
        </template>
      </div>
    </div>

    <!-- 🔹 Modifier les Types de Chambre -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier les Types de Chambre</h2>
      <div class="grid grid-cols-1 gap-6">
        <div
            v-for="type in roomTypes"
            :key="type.id"
            class="bg-white p-4 rounded shadow"
        >
          <UpdateField
              label="Nom du type"
              api-field="name"
              :url="`http://127.0.0.1:8000/api/type/update/${type.id}`"
              v-model="type.name"
          />
          <UpdateField
              label="Description"
              api-field="description"
              :url="`http://127.0.0.1:8000/api/type/update/${type.id}`"
              v-model="type.description"
          />
          <UpdateField
              label="Prix"
              api-field="price"
              :url="`http://127.0.0.1:8000/api/type/update/${type.id}`"
              v-model="type.price"
          />

          <!-- Affichage et mise à jour des 4 images du type -->
          <div class="mt-4">
            <h3 class="font-semibold mb-2">Modifier les images</h3>
            <div class="grid grid-cols-2 gap-2">
              <div
                  v-for="(imgType, index) in type.image_types"
                  :key="imgType.id"
                  class="border p-2 rounded flex flex-col items-center"
              >
                <img
                    :src="`http://127.0.0.1:8000/storage/${imgType.image}`"
                    alt="Image chambre"
                    class="w-[200px] h-[200px] object-cover rounded mb-2"
                />
                <UpdateField
                    label="Modifier cette image"
                    api-field="image"
                    type="file"
                    :url="`http://127.0.0.1:8000/api/type/updateImage/${imgType.id}`"
                />
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <!-- 🔹 Modifier les Réseaux Sociaux -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier les Réseaux Sociaux</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <template v-for="social in socialData" :key="social.id">
          <UpdateField
              :label="`Lien Réseau Social ${social.id}`"
              api-field="url"
              :url="`http://127.0.0.1:8000/api/social/update/${social.id}`"
              v-model="social.url"
          />
          <UpdateField
              :label="`Icône ${social.id}`"
              api-field="icon"
              type="file"
              :url="`http://127.0.0.1:8000/api/social/update/${social.id}`"
          />
        </template>
      </div>
    </div>
  </div>

</template>