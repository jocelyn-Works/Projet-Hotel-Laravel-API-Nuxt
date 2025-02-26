import { defineStore } from 'pinia';

// Définir un type pour les composants possibles
type ComponentName = 'navigation' | 'login'  | 'signup' | 'dates'| 'cart' | null;

export const useUiStore = defineStore('ui', {
  state: () => ({
    activeComponent: null as ComponentName,
  }),
  actions: {
    setActiveComponent(component: ComponentName) {
      // Définir le composant actif, en fermant tout autre composant
      this.activeComponent = component;
    },
    closeComponent() {
      this.activeComponent = null;
    },
  },
});
