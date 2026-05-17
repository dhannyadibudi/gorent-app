import { ref, onMounted } from 'vue'

import { bookingService } from '../services/booking.service'

export function useBookings() {

    const bookings = ref([])

    const loading = ref(false)

    const filters = ref({
        search: '',
        status: null,
    })

    const fetchBookings = async () => {

        loading.value = true

        try {

            const response = await bookingService.getAll(filters.value)

            bookings.value = response.data

        } catch (error) {

            console.error(error)

        } finally {

            loading.value = false
        }
    }

    onMounted(fetchBookings)

    return {
        bookings,
        loading,
        filters,
        fetchBookings,
    }
}