// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
    '@nuxt/ui', 
    '@nuxtjs/google-fonts', 
    '@pinia/nuxt'],
    build: {
      transpile: ['@pinia/nuxt'],
    },
  css: [
    'assets/css/index.css',
    
  ],
  tailwindcss: {
    configPath: 'tailwind.config.ts',
  },
  googleFonts: {
    families: {
      Satisfy: [400],
      Tahoma: [400],
    },
    display: 'swap',
  }
})