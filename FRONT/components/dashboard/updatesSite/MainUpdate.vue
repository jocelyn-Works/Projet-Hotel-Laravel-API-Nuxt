<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

const mainData = ref([]);

async function fetchMain() {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/main/all");
    const data = await response.json();
    if (data.length > 0) {
      mainData.value = data;
    }
  } catch (error) {
    console.error("Erreur lors du chargement du main:", error);
  }
}

onMounted(fetchMain);
</script>

<template>
  <div>
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
</template>