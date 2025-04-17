<template>
  <div class="bg-white p-4 rounded shadow-md">
    <label class="block font-semibold mb-2">{{ label }}</label>

    <!-- Champ texte -->
    <div v-if="type !== 'file'">
      <!-- Utilisation de UInput de NuxtUI pour le champ texte -->
      <UInput v-model="value" class="w-full" />
    </div>

    <!-- Champ fichier -->
    <div v-else>
      <input
          type="file"
          @change="handleFileUpload"
          class="border p-2 w-full"
      />
    </div>

    <div class="mt-2 flex gap-2">
      <!-- Utilisation de UButton de NuxtUI pour le bouton Update -->
      <UButton
          @click="updateData"
          class="bg-[#183456] hover:bg-gold-500 text-white px-4 py-2 rounded"
      >
        Update
      </UButton>

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
  modelValue: [String, File], // Donnée initiale venant de l'API
});

const emit = defineEmits(["update:modelValue"]);

const value = ref(props.modelValue || "");

// Met à jour la valeur locale et émet l'événement pour mettre à jour le parent
function updateValue(newValue) {
  value.value = newValue;
  emit("update:modelValue", newValue);
}

// Mise à jour automatique si la prop change

  modelValue: String, // Donnée initiale venant de l'API
});

const emit = defineEmits(["update:modelValue"]); // 🔥 Ajoute l'événement pour modifier `hotelData`

const value = ref(props.modelValue || "");

// ✅ Met à jour la valeur locale et émet un événement au parent
function updateValue(newValue) {
  value.value = newValue;
  emit("update:modelValue", newValue); // 🔥 Met à jour `hotelData` dans `update-website.vue`
}

// 🔄 Mise à jour auto si les données changent dans `update-website.vue`

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
    console.log("Envoi de la mise à jour à:", props.url);
    console.log("Données envoyées:", formData);

    const response = await fetch(props.url, {
      method: "POST",

    const response = await fetch(props.url, {
      method: "POST", // 🔥 Laravel attend POST, pas PUT !

      body: formData,
    });

    if (!response.ok) throw new Error("Échec de la mise à jour");

    alert("Mise à jour réussie !");
  } catch (error) {
    console.error("Erreur lors de la mise à jour :", error);
  }
}
</script>

