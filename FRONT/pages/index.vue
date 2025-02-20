<!-- pages/index.vue -->
<template>
  <div class="home-page">
    <Header />
    <section class="hero">
<!--      <img src="~/public/ImagesHomepage/hotel-luxe.png" alt="Hôtel Artichaut" />-->
      <button class="date-button" @click="showCalendar = !showCalendar">Dates</button>
      <div v-if="showCalendar" class="calendar-container">
        <v-date-picker v-model="dateRange" is-range />
      </div>
    </section>
    <section class="features">
      <div class="feature">
        <h2>Chambres Confortables</h2>
        <p>Profitez de nos chambres spacieuses et confortables pour un séjour inoubliable.</p>
      </div>
      <div class="feature">
        <h2>Restaurant Gastronomique</h2>
        <p>Dégustez des plats raffinés dans notre restaurant, ouvert tous les jours.</p>
      </div>
      <div class="feature">
        <h2>Services de Qualité</h2>
        <p>Nous offrons une gamme complète de services pour rendre votre séjour agréable.</p>
      </div>
    </section>
    <Footer />
  </div>
</template>

<script>
import { ref } from 'vue';
import Header from '~/components/AppHeader.vue';
import Footer from '~/components/AppFooter.vue';
import { DatePicker } from 'v-calendar';

export default {
  name: 'HomePage',
  components: {
    Header,
    Footer,
    'v-date-picker': DatePicker,
  },
  setup() {
    const showCalendar = ref(false);
    const dateRange = ref({ start: null, end: null });

    return {
      showCalendar,
      dateRange,
    };
  },
};
</script>

<style scoped>
.home-page {
  font-family: Arial, sans-serif;
  padding: 20px;
}
.hero img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
}
.date-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.date-button:hover {
  background-color: #0056b3;
}
.calendar-container {
  margin-top: 20px;
}
.features {
  display: flex;
  justify-content: space-around;
  margin-top: 40px;
}
.feature {
  max-width: 300px;
}
</style>

