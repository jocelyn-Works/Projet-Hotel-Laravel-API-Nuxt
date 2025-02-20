// https://nuxt.com/docs/api/configuration/nuxt-config
import { defineNuxtConfig } from 'nuxt/config'
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
      '@nuxt/ui',

  ],
    axios: {
        baseURL: 'http://127.0.0.1:8000/api', // URL de base de votre API
    },
})