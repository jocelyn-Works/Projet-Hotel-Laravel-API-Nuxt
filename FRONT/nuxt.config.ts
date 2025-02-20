// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: ['@nuxt/ui', '@nuxtjs/google-fonts'],
  tailwindcss: {
    config: {
      theme: {
        extend: { 
          colors: {
            'dark-blue': {
              DEFAULT: '#183456',
              50: '#568DD0',
              100: '#4682CB',
              200: '#336EB6',
              300: '#2A5B96',
              400: '#214776',
              500: '#183456',  // DEFAULT
              600: '#0C192A',
              700: '#000000',
              800: '#000000',
              900: '#000000',
              950: '#000000'
            },
            'theme': {
              DEFAULT: '#EDE4D9',
              50: '#FFFFFF',
              100: '#FFFFFF',
              200: '#FFFFFF',
              300: '#FFFFFF',
              400: '#FAF8F5',
              500: '#EDE4D9', //  DEFAULT
              600: '#DBC9B3',
              700: '#C9AE8D',
              800: '#B79367',
              900: '#9C774A',
              950: '#896841'
            },
          }
        }
      }
    }
  },
  googleFonts: {
    families: {
      Satisfy: [400], 
      Poppins: [400], 
    },
    display: 'swap',
  }
})