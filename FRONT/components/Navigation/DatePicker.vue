<template>
  <section class="fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">
    <div class="flex items-center w-full bg-dark-blue-500 p-4">
      <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeDates" />
      <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Vos Dates</h2>
    </div>
    <div class="w-full h-full p-4">
      <div class="p-4">
        <!-- Bouton affichant les dates sélectionnées -->
        <div class="flex justify-center mb-4 ">
          <UButton icon="i-heroicons-calendar-days-20-solid" class="uboutton ">
            {{ format(selected.start, 'd MMM, yyy') }} - {{ format(selected.end, 'd MMM, yyy') }}
          </UButton>
        </div>

        <!-- sélecteur de dates -->
        <div class="flex justify-center bg-dark-blue-500 border border-dark-blue-500 rounded-lg">
          <VCalendarDatePicker
              v-model="selected"
              :columns="2"
              v-bind="attrs"
              is-range
              :attributes="calendarAttributes"
              :min-date="new Date()"
              @dayclick="onDayClick"
          />
        </div>

        <div class="flex justify-center items-center p-10 mt-2">
          <div class="flex justify-evenly items-center w-full border border-dark-blue-500 rounded-2xl text-dark-blue-500 p-4 space-x-4">

            <p class="text-xl font-bold">Nombre de Personne</p>
            
            <div class="flex justify-center items-center rounded-full bg-dark-blue-500 w-10 h-10">
              <UIcon name="weui:add-filled" class="cursor-pointer bg-white w-8 h-8 " @click="incrementCount" />
            </div>
            
          
            <span class="text-xl font-semibold">{{ count }}</span>
            
            <div class="flex justify-center items-center rounded-full bg-dark-blue-500 w-10 h-10">

            <UIcon name="ep:minus" class="cursor-pointer  bg-white w-8 h-8" @click="decrementCount" />
            </div>
          </div>
        </div>


        <div class="flex justify-center ">
          
    
          <UButton
            class="bg-dark-blue-400 !text-white !text-2xl !px-4 !py-2 "
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

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useUiStore } from '~/stores/ui';
import { DatePicker as VCalendarDatePicker } from 'v-calendar';
import { sub, format, parseISO } from 'date-fns';
import 'v-calendar/dist/style.css';

const uiStore = useUiStore();

const closeDates = () => {
  uiStore.closeComponent();
};

const selected = ref({
  start: sub(new Date(), { days: 0 }),
  end: new Date()
});

const attrs = {
  'transparent': true,
  'borderless': true,
  'color': 'primary',
  'is-dark': { selector: 'html', darkClass: 'dark' },
  'first-day-of-week': 2
};

const calendarAttributes = computed(() => [
  {
    key: 'today',
    dates: new Date(),

    popover: {
      label: 'Aujourd\'hui'
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

function onDayClick(_: any, event: MouseEvent): void {
  const target = event.target as HTMLElement;
  target.blur();
}


// nb de personne 

const count = ref(0);

const incrementCount = () => {
  count.value++;
};

const decrementCount = () => {
  if (count.value > 0) {
    count.value--;
  }
};
</script>

<style scoped>
/* Transition styles */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.4s ease;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateX(100%);
}

.slide-enter-to,
.slide-leave-from {
  transform: translateX(0);
}

.uboutton{
  background-color: #F9F9F6;
  border: 1px solid black;
}
.uboutton:hover {
  background-color: #F9F9F6;
}




</style>
