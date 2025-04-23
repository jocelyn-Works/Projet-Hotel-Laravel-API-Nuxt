// front/composables/useApi.ts

export const useApi = async <T>(url: string, options = {}) => {
    const config = useRuntimeConfig()
    const fullUrl = `${config.public.apiUrl}/api${url}`

    const data = ref<T | null>(null)
    const error = ref<Error | null>(null)
    const isLoading = ref(true)

    try {
        data.value = await $fetch<T>(fullUrl, options)
    } catch (err) {
        error.value = err as Error
        console.error(`❌ Erreur sur ${fullUrl} :`, err)
    } finally {
        isLoading.value = false
    }

    return { data, error, isLoading }
}