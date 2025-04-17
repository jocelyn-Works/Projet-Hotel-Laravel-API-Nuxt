<script setup>

import { ref } from "vue";
import HotelUpdate from "@/components/dashboard/updatesSite/HotelUpdate.vue";
import HeaderUpdate from "@/components/dashboard/updatesSite/HeaderUpdate.vue";
import MainUpdate from "@/components/dashboard/updatesSite/MainUpdate.vue";
import SocialUpdate from "@/components/dashboard/updatesSite/SocialUpdate.vue";
import TypeUpdate from "@/components/dashboard/updatesSite/TypeUpdate.vue";
import UserUpdate from "~/components/dashboard/updatesSite/UserUpdate.vue";

definePageMeta({
  layout: 'admin'
});

// Liste des sections avec leur label et composant associé
const sections = [
  { label: "Hôtel", component: HotelUpdate },
  { label: "Header", component: HeaderUpdate },
  { label: "Main", component: MainUpdate },
  { label: "Types", component: TypeUpdate },
  { label: "Social", component: SocialUpdate },
  { label: "User", component: UserUpdate }
];

// Composant actuellement affiché (par défaut, le premier)
const currentComponent = ref(sections[0].component);

function changeSection(comp) {
  currentComponent.value = comp;
}

</script>

<template>
  <div>

    <!-- Menu de navigation fixe -->
    <div class=" text-white p-4 flex space-x-4 z-10">
      <UButton
          v-for="section in sections"
          :key="section.label"
          @click="changeSection(section.component)"
          variant="solid"
          color="primary"
          class="rounded hover:bg-gold-500"

      >
        {{ section.label }}
      </UButton>
    </div>

    <!-- Zone de contenu décalée pour ne pas être couverte par le menu fixe -->
    <div class="pt-20">
      <component :is="currentComponent" />
    </div>
  </div>

</template>