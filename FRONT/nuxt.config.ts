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
              DEFAULT: '#F9F9F6',
              50: '#FFFFFF',
              100: '#FFFFFF',
              200: '#FFFFFF',
              300: '#FFFFFF',
              400: '#FFFFFF',
              500: '#F9F9F6', // DEFAULT
              600: '#E3E3D4',
              700: '#CCCCB3',
              800: '#B6B691',
              900: '#9F9F6F',
              950: '#929261'
            },
            'belgian': {
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
            'gold': {
            DEFAULT: '#D39A31',
            50: '#F3E4C8',
            100: '#F0DCB7',
            200: '#E9CB96',
            300: '#E1BB74',
            400: '#DAAA53',
            500: '#D39A31',  //  DEFAULT
            600: '#A87A24',
            700: '#7A581A',
            800: '#4C3710',
            900: '#1D1506',
            950: '#060401'
          },
          }
        }
      }
    }
  },
  googleFonts: {
    families: {
      Satisfy: [400], 
      Tahoma: [400], 
    },
    display: 'swap',
  }
})