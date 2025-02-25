<template>

    <section class="fixed top-0 right-0 w-full md:w-2/5 bg-belgian-500 border border-dark-blue-500 rounded-bl-lg z-10">

      <div class="flex items-center w-full bg-dark-blue-500 p-4">
        <UIcon name="heroicons-solid:x-mark" class="w-6 h-6 text-white cursor-pointer" @click="closeConnexion" />
        <h2 class="text-theme-500 text-3xl satisfy flex-grow text-center">Connexion</h2>
      </div>

      <div class="flex justify-center w-full   p-10 ">

      
      <form action="">

        <div class="form-control">
            <input type="email" name="email" id="email" required>
            <label for="email"> Email </label>
        </div>

        <div class="form-control">
            <input type="password" name="password" id="password" required>
            <label for="password"> Mot de Passe </label>
        </div>
        

        
        <button class="p-2 bg-dark-blue-500 rounded-lg w-full ">Connexion</button>

      </form>

    </div>


    </section>

  </template>

<script setup>


import { onMounted } from 'vue';

onMounted(() => {
  const labels = document.querySelectorAll(".form-control label");

  labels.forEach((label) => {
    label.innerHTML = label.innerText
      .split("")
      .map((letter, idx) =>
        `<span style="transition-delay:${idx * 50}ms">${letter}</span>`
      )
      .join("");
  });
});

// btn close 

const emit = defineEmits(['close']);
  
  const closeConnexion = () => {
    emit('close');
  };
</script>

<style scoped>


/* Transition styles */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.4s ease;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateX(100%);
}

.slide-enter-to,
.slide-leave-from {
  transform: translateX(0);
}
</style>

  