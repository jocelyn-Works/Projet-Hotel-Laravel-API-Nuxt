<script setup lang="ts">
import { CalendarDate, DateFormatter, getLocalTimeZone } from '@internationalized/date';
import { useUiStore } from '~/stores/ui';
import { useDatesStore } from '~/stores/dates'; // Import du store Pinia
import { computed } from 'vue';

const df = new DateFormatter('en-US', {
  dateStyle: 'medium'
});

// Store des dates sélectionnées
const datesStore = useDatesStore();
const uiStore = useUiStore();

const openDates = () => {
  uiStore.setActiveComponent('dates');
};

// Transformer les dates stockées en CalendarDate pour affichage
const modelValue = computed(() => {
  if (datesStore.selectedDates.start && datesStore.selectedDates.end) {
    return {
      start: new CalendarDate(...datesStore.selectedDates.start.split('-').map(Number)), // Convertir YYYY-MM-DD en CalendarDate
      end: new CalendarDate(...datesStore.selectedDates.end.split('-').map(Number))
    };
  }
  return { start: null, end: null };
});
</script>

<template>
  <UPopover class="border border-black rounded-md w-1/5">
    <UButton @click="openDates" color="gray" variant="ghost" icon="i-lucide-calendar">
      <template v-if="modelValue.start">
        <template v-if="modelValue.end">
          {{ df.format(modelValue.start.toDate(getLocalTimeZone())) }} - {{ df.format(modelValue.end.toDate(getLocalTimeZone())) }}
        </template>
        <template v-else>
          {{ df.format(modelValue.start.toDate(getLocalTimeZone())) }}
        </template>
      </template>
      <template v-else>
        Pick a date
      </template>
    </UButton>
  </UPopover>
</template>