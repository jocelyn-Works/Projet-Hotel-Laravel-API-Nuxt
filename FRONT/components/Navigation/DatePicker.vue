<script setup lang="ts">
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import { useUiStore } from '~/stores/ui';
import { useDatesStore } from '~/stores/dates';
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

const errorMessage = ref('');

const attrs = {
  transparent: true,
  borderless: true,
  color: 'primary',
  isDark: true,
  firstDayOfWeek: 2
};

// 🖥️ Détection de la taille de l'écran
const calendarColumns = ref(1); // Par défaut, 1 mois (mobile)

const updateCalendarColumns = () => {
  calendarColumns.value = window.innerWidth >= 1024 ? 2 : 1; // en dessous de 1024 affiché que 1 mois
};

// Ajouter un écouteur d'événement pour détecter le redimensionnement
onMounted(() => {
  updateCalendarColumns(); // Exécuter au montage
  window.addEventListener('resize', updateCalendarColumns);
});

// Nettoyage de l'écouteur lors du démontage du composant
onUnmounted(() => {
  window.removeEventListener('resize', updateCalendarColumns);
});

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

async function verifierDisponibilite() {
  errorMessage.value = '';

  if (!selected.value.start || !selected.value.end) {
    console.error("Aucune date sélectionnée !");
    return;
  }

  datesStore.setDates(selected.value.start, selected.value.end);


  // Ferme la modal
  uiStore.closeComponent();

  router.push('/booking');
}

const count = ref(1);

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
  <section class="nav fixed top-0 right-0 w-full md:w-2/4 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10 dark:text-black z-10">

    <div class="flex items-center w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeDates" />
      <h2 class="text-theme-500 text-2xl sm:text-3xl md:text-4xl satisfy flex-grow text-center">Vos Dates</h2>
    </div>

    <div class="w-full h-full p-4">
      <div class="p-4">
        <div class="flex justify-center mb-4">
          <UButton icon="i-heroicons-calendar-days-20-solid" class="uboutton px-4 py-2 text-sm sm:text-base">
            {{ format(selected.start, 'd MMM, yyyy') }} - {{ format(selected.end, 'd MMM, yyyy') }}
          </UButton>
        </div>

        <!-- Sélecteur de dates -->
        <div class="flex justify-center bg-dark-blue-500 border border-dark-blue-500 rounded-lg">
          <VCalendarDatePicker
              v-model.range="selected"
              :columns="calendarColumns"
              class="w-full sm:w-auto"
              v-bind="attrs"
              :attributes="calendarAttributes"
              :min-date="new Date()"
          />
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center p-6 mt-2 space-y-4 sm:space-y-0 sm:space-x-4">
          <p class="text-lg sm:text-xl font-bold text-dark-blue-500">Nombre de Personnes</p>
          <div class="flex justify-evenly items-center w-full sm:w-auto border border-dark-blue-500 rounded-2xl text-dark-blue-500 p-4 space-x-4">
            <div class="flex justify-center items-center rounded-full bg-dark-blue-500 w-8 h-8 sm:w-10 sm:h-10">
              <UIcon name="weui:add-filled" class="cursor-pointer bg-white w-6 h-6 sm:w-8 sm:h-8" @click="incrementCount" />
            </div>
            <span class="text-lg sm:text-xl font-semibold">{{ count }}</span>
            <div class="flex justify-center items-center rounded-full bg-dark-blue-500 w-8 h-8 sm:w-10 sm:h-10">
              <UIcon name="ep:minus" class="cursor-pointer bg-white w-6 h-6 sm:w-8 sm:h-8" @click="decrementCount" />
            </div>
          </div>
        </div>

        <p v-if="errorMessage" class="text-red-500 text-center font-bold mt-4 text-sm sm:text-base">{{ errorMessage }}</p>

        <div class="flex justify-center">
          <button
              @click="verifierDisponibilite"
              class="bg-dark-blue-400 text-white rounded-full text-lg sm:text-2xl px-3 sm:px-4 py-2
         transition-all duration-300 ease-in-out transform hover:bg-dark-blue-300 hover:-translate-y-1 hover:shadow-lg
         active:translate-y-0 active:shadow-md"
          >
            Confirmer la sélection
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.uboutton {
  background-color: #F9F9F6;
  color: black;
  border: 1px solid black;
}
.uboutton:hover {
  background-color: #F9F9F6;
}

.vc-title-wrapper {
  color: white;
}
</style>
