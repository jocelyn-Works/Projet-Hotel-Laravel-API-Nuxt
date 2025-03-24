// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
    '@nuxt/ui', 
    '@nuxtjs/google-fonts', 
    '@pinia/nuxt',
    '@nuxtjs/color-mode'],
  colorMode: {
    classSuffix: '',
  },
    build: {
      transpile: ['@pinia/nuxt'],
    },
  css: [
    'assets/css/index.css',
    
  ],
  tailwindcss: {
    cssPath: '~/assets/css/tailwind.css',
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