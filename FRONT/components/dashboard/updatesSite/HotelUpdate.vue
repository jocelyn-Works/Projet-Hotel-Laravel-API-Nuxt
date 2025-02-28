<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

const hotelData = ref({});
const hotelId = ref(null);

async function fetchHotel() {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/hotel/all");
    const data = await response.json();
    if (data.length > 0) {
      hotelData.value = { ...data[0] };
      hotelId.value = data[0].id;
    }
  } catch (error) {
    console.error("Erreur lors du chargement de l'hôtel:", error);
  }
}

onMounted(fetchHotel);
</script>

<template>
  <div>
    <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier l'Hôtel</h2>
    <div v-if="hotelId" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <UpdateField label="Nom de l'hôtel" api-field="name" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.name" />
      <UpdateField label="Adresse" api-field="street" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.street" />
      <UpdateField label="Ville" api-field="city" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.city" />
      <UpdateField label="Téléphone" api-field="phone_number" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.phone_number" />
      <UpdateField label="Email" api-field="email" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" v-model="hotelData.email" />
      <UpdateField label="Logo de l'hôtel" api-field="image" type="file" :url="`http://127.0.0.1:8000/api/hotel/update/${hotelId}`" />
    </div>
  </div>
</template>