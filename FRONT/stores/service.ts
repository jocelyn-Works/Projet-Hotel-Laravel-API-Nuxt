import { defineStore } from 'pinia';

interface Service {
    id: number;
    name: string;
    price: number;
    description?: string;
}

const apiUrl = import.meta.env.VITE_API_URL;
export const useServiceStore = defineStore('service', () => {
    const services = ref<Service[]>([]);
    const loading = ref(false);
    const error = ref<string | null>(null);

    const fetchServices = async () => {
        loading.value = true;
        error.value = null;

        try {
            const { data, error: fetchError } = await useFetch<Service[]>(`${apiUrl}/service/show`);

            if (fetchError.value) {
                error.value = fetchError.value.message;
            } else if (data.value) {
                services.value = data.value;
            }
        } catch (err) {
            error.value = 'Une erreur est survenue';
            console.error(err);
        } finally {
            loading.value = false;
        }
    };

    return { services, loading, error, fetchServices };
});
