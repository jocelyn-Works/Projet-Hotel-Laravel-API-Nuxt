<template>
  <div class="bg-white p-4 rounded shadow-md">
    <label class="block font-semibold mb-2">{{ label }}</label>

    <!-- Champ texte -->
    <input
        v-if="type !== 'file'"
        :value="value"
        @input="updateValue($event.target.value)"
        class="border p-2 w-full"
    />

    <!-- Champ fichier -->
    <input
        v-else
        type="file"
        @change="handleFileUpload"
        class="border p-2 w-full"
    />

    <div class="mt-2 flex gap-2">
      <button @click="updateData" class="bg-[#183456] text-white px-4 py-2 rounded">Update</button>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  label: String,
  apiField: String,
  type: { type: String, default: "text" },
  url: String,
  modelValue: String, // Donnée initiale venant de l'API
});

const emit = defineEmits(["update:modelValue"]); // Ajoute l'événement pour modifier `hotelData`

const value = ref(props.modelValue || "");

// Met à jour la valeur locale et émet un événement au parent
function updateValue(newValue) {
  value.value = newValue;
  emit("update:modelValue", newValue);
}

//  Mise à jour auto si les données changent dans `update-website.vue`
watch(() => props.modelValue, (newValue) => {
  value.value = newValue;
});

function handleFileUpload(event) {
  value.value = event.target.files[0];
  emit("update:modelValue", value.value);
}

async function updateData() {
  try {
    const formData = new FormData();
    formData.append(props.apiField, value.value);

    const response = await fetch(props.url, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) throw new Error("Échec de la mise à jour");

    alert("Mise à jour réussie !");
  } catch (error) {
    console.error("Erreur lors de la mise à jour :", error);
  }
}
</script>
