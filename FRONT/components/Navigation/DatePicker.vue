<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { useUiStore } from '~/stores/ui';
import { useDatesStore } from '~/stores/dates'; // Import du store des dates
import { useRouter } from 'vue-router';
import { DatePicker as VCalendarDatePicker } from 'v-calendar';
import { sub, format } from 'date-fns';
import 'v-calendar/dist/style.css';

const uiStore = useUiStore();
const datesStore = useDatesStore();
const router = useRouter();

const closeDates = () => {
  uiStore.closeComponent();
};

const selected = ref({
  start: sub(new Date(), { days: 0 }),
  end: new Date()
});

const errorMessage = ref(''); // Message d'erreur si aucune chambre n'est disponible

const attrs = {
  transparent: true,
  borderless: true,
  color: 'primary',
  isDark: { selector: 'html', darkClass: 'dark' },
  firstDayOfWeek: 2
};

const calendarAttributes = computed(() => [
  {
    key: 'today',
    dates: new Date(),
    popover: {
      label: "Aujourd'hui"
    }
  },
  {
    key: 'range',
    dates: {
      start: selected.value.start,
      end: selected.value.end
    },
    highlight: {
      color: 'blue',
      fillMode: 'light'
    },
    contentStyle: {
      color: 'black'
    }
  }
]);

// Vérifier les chambres disponibles et rediriger si dispo
async function verifierDisponibilite() {
  errorMessage.value = ''; // Réinitialisation du message d'erreur

  // Vérifie que l'utilisateur a bien sélectionné des dates
  if (!selected.value.start || !selected.value.end) {
    console.error("Aucune date sélectionnée !");
    return;
  }

  // Stocker les dates dans Pinia (pour que `booking.vue` les récupère)
  datesStore.setDates(selected.value.start, selected.value.end);

  // Afficher les données envoyées dans la console
  console.log("🔹 Données enregistrées :", {
    dateDebut: datesStore.selectedDates.start,
    dateFin: datesStore.selectedDates.end
  });

  // Ferme la modal
  uiStore.closeComponent();

  // l'appel à l'API
   router.push('/booking');
}

// nb de personnes
const count = ref(1); // Début à 1 personne par défaut

const incrementCount = () => {
  count.value++;
};

const decrementCount = () => {
  if (count.value > 1) {
    count.value--;
  }
};
</script>

<template>
  <section class="fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">
    <div class="flex items-center w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeDates" />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Vos Dates</h2>
    </div>
    <div class="w-full h-full p-4">
      <div class="p-4">
        <!-- Bouton affichant les dates sélectionnées -->
        <div class="flex justify-center mb-4">
          <UButton icon="i-heroicons-calendar-days-20-solid" class="uboutton">
            {{ format(selected.start, 'd MMM, yyyy') }} - {{ format(selected.end, 'd MMM, yyyy') }}
          </UButton>
        </div>

        <!-- Sélecteur de dates -->
        <div class="flex justify-center bg-dark-blue-500 border border-dark-blue-500 rounded-lg">
          <VCalendarDatePicker
              v-model="selected"
              :columns="2"
              v-bind="attrs"
              is-range
              :attributes="calendarAttributes"
              :min-date="new Date()"
          />
        </div>

        <!-- Sélection du nombre de personnes -->
        <div class="flex justify-center items-center p-10 mt-2">
          <div class="flex justify-evenly items-center w-full border border-dark-blue-500 rounded-2xl text-dark-blue-500 p-4 space-x-4">
            <p class="text-xl font-bold">Nombre de Personnes</p>
            <div class="flex justify-center items-center rounded-full bg-dark-blue-500 w-10 h-10">
              <UIcon name="weui:add-filled" class="cursor-pointer bg-white w-8 h-8" @click="incrementCount" />
            </div>
            <span class="text-xl font-semibold">{{ count }}</span>
            <div class="flex justify-center items-center rounded-full bg-dark-blue-500 w-10 h-10">
              <UIcon name="ep:minus" class="cursor-pointer bg-white w-8 h-8" @click="decrementCount" />
            </div>
          </div>
        </div>



        <!-- Bouton de confirmation -->
        <div class="flex justify-center">
          <UButton
              @click="verifierDisponibilite"
              class="bg-dark-blue-400 !text-white !text-2xl !px-4 !py-2"
              variant="solid"
              size="md"
          >
            Confirmer la sélection
          </UButton>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.uboutton {
  background-color: #F9F9F6;
  border: 1px solid black;
}
.uboutton:hover {
  background-color: #F9F9F6;
}
</style>
