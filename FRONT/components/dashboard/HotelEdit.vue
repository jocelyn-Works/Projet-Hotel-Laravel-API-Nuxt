<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Modifier l'Hôtel</h1>

    <UpdateField label="Nom de l'hôtel" apiField="name" :url="apiUrl" />
    <UpdateField label="Adresse" apiField="street" :url="apiUrl" />
    <UpdateField label="Ville" apiField="city" :url="apiUrl" />
    <UpdateField label="Téléphone" apiField="phone_number" :url="apiUrl" />
    <UpdateField label="Email" apiField="email" :url="apiUrl" />
    <UpdateField label="Image de l'hôtel" apiField="image" type="file" :url="apiUrl" />
  </div>
</template>

<script setup>
import UpdateField from "@/components/dashboard/UpdateField.vue";

const apiUrl = "http://127.0.0.1:8000/api/home/updateHotel/1";
</script>