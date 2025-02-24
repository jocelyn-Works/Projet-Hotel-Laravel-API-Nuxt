<template>
  <div class="bg-white p-4 rounded shadow-md">
    <label class="block font-semibold mb-2">{{ label }}</label>
    <input v-if="type !== 'file'" v-model="value" class="border p-2 w-full" />
    <input v-else type="file" @change="handleFileUpload" class="border p-2 w-full" />

    <div class="mt-2 flex gap-2">
      <button @click="updateData" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
      <button @click="deleteData" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
  label: String,
  apiField: String,
  type: { type: String, default: 'text' }
});

const value = ref('');

function handleFileUpload(event) {
  value.value = event.target.files[0];
}

async function updateData() {
  const formData = new FormData();
  formData.append(apiField, value.value);

  await fetch(`http://localhost:8000/api/site`, {
    method: 'PUT',
    body: formData
  });
}

async function deleteData() {
  await fetch(`http://localhost:8000/api/site/${apiField}`, {
    method: 'DELETE'
  });
}
</script>