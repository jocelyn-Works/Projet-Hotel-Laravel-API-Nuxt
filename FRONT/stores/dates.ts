import { defineStore } from 'pinia';

export const useDatesStore = defineStore('dates', {
    state: () => ({
        selectedDates: {
            start: null as string | null,
            end: null as string | null
        }
    }),
    actions: {
        setDates(start: Date, end: Date) {
            this.selectedDates.start = start.toISOString().split('T')[0]; // YYYY-MM-DD
            this.selectedDates.end = end.toISOString().split('T')[0];
        },
        resetDates() {
            this.selectedDates.start = null;
            this.selectedDates.end = null;
        }
    }
});