// middleware/auth-admin.ts
import { defineNuxtRouteMiddleware, navigateTo } from 'nuxt/app';


export default defineNuxtRouteMiddleware(async (to, from) => {
    const userStore = useUserStore();

    console.log('Middleware auth-admin executed');
    console.log('Token:', userStore.token);

    // Vérifiez si l'utilisateur est connecté
    if (!userStore.token) {
        return navigateTo('/');
    }

    // Vérifiez si l'utilisateur a les droits d'administrateur
    await userStore.fetchUser();
    console.log('User:', userStore.user);

    // Vérifiez si l'utilisateur a les droits d'administrateur
    await userStore.fetchUser();
    if (!userStore.user?.is_admin) {
        return navigateTo('/');
    }
});