<template>

    <section class="fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">

      <div class="flex items-center w-full bg-dark-blue-500 p-4">
        <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeDates" />
        <h2 class="text-theme-500 text-4xl satisfy flex-grow text-center">Vos Dates</h2>
      </div>
      <div class="w-full h-full p-4">


        <div class="p-4">


            <UPopover :popper="{ placement: 'bottom-start' }">
              <UButton icon="i-heroicons-calendar-days-20-solid">
                {{ format(selected.start, 'd MMM, yyy') }} - {{ format(selected.end, 'd MMM, yyy') }}
              </UButton>

              <template #panel="{ close }">
                <div class="flex items-center sm:divide-x divide-gray-200 dark:divide-gray-800">
                  <div class="hidden sm:flex flex-col py-4">
                    <UButton
                        v-for="(range, index) in ranges"
                        :key="index"
                        :label="range.label"
                        color="gray"
                        variant="ghost"
                        class="rounded-none px-6"
                        :class="[isRangeSelected(range.duration) ? 'bg-gray-100 dark:bg-gray-800' : 'hover:bg-gray-50 dark:hover:bg-gray-800/50']"
                        truncate
                        @click="selectRange(range.duration)"
                    />
                  </div>

                  <DatePicker v-model="selected" @close="close" />
                </div>
              </template>
            </UPopover>


        </div>

      </div>

    </section>

  </template>

<script setup lang="ts">

import { useUiStore } from '~/stores/ui';


const uiStore = useUiStore();

const closeDates = () => {
  uiStore.closeComponent();
};


import { sub, format, isSameDay, type Duration } from 'date-fns'

const ranges = [
  { label: 'Last 7 days', duration: { days: 7 } },
  { label: 'Last 14 days', duration: { days: 14 } },
  { label: 'Last 30 days', duration: { days: 30 } },
  { label: 'Last 3 months', duration: { months: 3 } },
  { label: 'Last 6 months', duration: { months: 6 } },
  { label: 'Last year', duration: { years: 1 } }
]
const selected = ref({ start: sub(new Date(), { days: 14 }), end: new Date() })

function isRangeSelected(duration: Duration) {
  return isSameDay(selected.value.start, sub(new Date(), duration)) && isSameDay(selected.value.end, new Date())
}

function selectRange(duration: Duration) {
  selected.value = { start: sub(new Date(), duration), end: new Date() }
}


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
</style>

  