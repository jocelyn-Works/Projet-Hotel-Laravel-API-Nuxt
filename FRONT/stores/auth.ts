import { defineStore } from 'pinia';




interface UserState {
  user: any | null;
  token: string | null;
}

export const useUserStore = defineStore('user', {
  state: (): UserState => ({
    user: null,
    token: localStorage.getItem('authToken') || null,
  }),
  actions: {
    async fetchUser() {
      if (!this.token) return;
      const config = useRuntimeConfig();
      const apiUrl = config.public.apiUrl;

      const { data, error } = await useFetch(`${apiUrl}/user`, {
        headers: {
          'Authorization': `Bearer ${this.token}`,
        },
      });

      if (data.value) {
        this.user = data.value;
      } else if (error.value) {
        console.error('Erreur lors de la récupération de l\'utilisateur :', error.value);
      }
    },
    logout() {
      this.user = null;
      this.token = null;
      localStorage.removeItem('authToken');
    },
  },
});
