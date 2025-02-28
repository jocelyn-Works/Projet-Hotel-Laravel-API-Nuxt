<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

const socialData = ref([]);

async function fetchSocial() {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/social/all");
    const data = await response.json();
    if (data.length > 0) {
      socialData.value = data;
    }
  } catch (error) {
    console.error("Erreur lors du chargement des réseaux sociaux:", error);
  }
}

onMounted(fetchSocial);
</script>

<template>
  <div>
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
</template>