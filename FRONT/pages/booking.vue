<!-- pages/booking.vue -->
<template>
  <div class="booking-page">
    <h1>Réservation</h1>
    <form @submit.prevent="submitBooking">
      <div>
        <label for="checkin">Date d'arrivée :</label>
        <input type="date" id="checkin" v-model="checkinDate" required />
      </div>
      <div>
        <label for="checkout">Date de départ :</label>
        <input type="date" id="checkout" v-model="checkoutDate" required />
      </div>
      <div>
        <label for="guests">Nombre de personnes :</label>
        <input type="number" id="guests" v-model="guests" min="1" required />
      </div>
      <button type="submit">Réserver</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      checkinDate: '',
      checkoutDate: '',
      guests: 1
    };
  },
  methods: {
    submitBooking() {
      // Logique de soumission de la réservation
      console.log('Réservation soumise :', {
        checkinDate: this.checkinDate,
        checkoutDate: this.checkoutDate,
        guests: this.guests
      });
    }
  }
};
</script>

<style scoped>
.booking-page {
  max-width: 600px;
  margin: auto;
  padding: 20px;
}
</style>