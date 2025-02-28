<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

const headerData = ref({});

async function fetchHeader() {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/header/all");
    const data = await response.json();
    if (data.length > 0) {
      headerData.value = { ...data[0] };
    }
  } catch (error) {
    console.error("Erreur lors du chargement du header:", error);
  }
}

onMounted(fetchHeader);
</script>

<template>
  <div>
    <h2 class="text-xl font-semibold mb-2 text-gold-500">Modifier le Header</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <UpdateField label="Contenu" api-field="content" :url="`http://127.0.0.1:8000/api/header/update/1`" v-model="headerData.content" />
      <UpdateField label="Image du Header" api-field="image" type="file" :url="`http://127.0.0.1:8000/api/header/update/1`" />
    </div>
  </div>
</template>