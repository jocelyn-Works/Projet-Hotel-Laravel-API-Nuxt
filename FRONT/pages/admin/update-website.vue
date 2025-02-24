<script setup>
definePageMeta({
  layout: 'admin'
});
import UpdateField from '~/components/dashboard/UpdateField.vue'
</script>
<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Mise à jour du site</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <UpdateField label="Nom de l'hôtel" api-field="name" />
      <UpdateField label="Téléphone" api-field="phone" />
      <UpdateField label="Email" api-field="email" />
      <UpdateField label="Adresse" api-field="street" />
      <UpdateField label="Image principale" api-field="image" type="file" />
      <UpdateField label="Image du header" api-field="header_image" type="file" />
      <UpdateField label="Texte du header" api-field="header_text" />
    </div>
  </div>
</template>

