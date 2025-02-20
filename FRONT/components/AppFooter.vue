<template>
  <footer class="footer">
    <div class="container">
      <h2>Nos Hôtels</h2>
      <div v-for="hotel in hotels" :key="hotel.id" class="hotel-item">
        <h3>{{ hotel.name }}</h3>
        <p>{{ hotel.street }}, {{ hotel.city }}</p>
        <p>Téléphone: {{ hotel.phone_number }}</p>
        <p>Email: {{ hotel.email }}</p>
        <img :src="hotel.image_url" :alt="hotel.name" />
      </div>
    </div>
  </footer>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import { useFetch } from '#app'

export default defineComponent({
  setup() {
    const hotels = ref([])

    onMounted(async () => {
      const { data, error } = await useFetch('/api/home/hotel')
      if (data.value) {
        hotels.value = data.value
      } else {
        console.error('Erreur lors de la récupération des données de l\'API:', error.value)
      }
    })

    return {
      hotels
    }
  }
})
</script>

<style scoped>
.footer {
  background-color: #f8f9fa;
  padding: 20px 0;
  text-align: center;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.hotel-item {
  margin-bottom: 20px;
}

h2 {
  margin-bottom: 20px;
}

h3 {
  margin-bottom: 10px;
}

p {
  margin: 5px 0;
}

img {
  max-width: 100%;
  height: auto;
}
</style>