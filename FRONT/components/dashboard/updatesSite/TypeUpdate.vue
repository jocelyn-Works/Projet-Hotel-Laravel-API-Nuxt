<script setup>
import { ref, onMounted } from "vue";
import UpdateField from "@/components/dashboard/UpdateField.vue";

const roomTypes = ref([]);

async function fetchTypes() {
  try {
    const response = await fetch("http://127.0.0.1:8000/api/type/all");
    const data = await response.json();
    roomTypes.value = data;
  } catch (error) {
    console.error("Erreur lors du chargement des types de chambre:", error);
  }
}

onMounted(fetchTypes);
</script>

<template>
  <div>
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


        <!-- Mise à jour des 4 images associées -->
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
                  alt="Image du type"
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
</template>