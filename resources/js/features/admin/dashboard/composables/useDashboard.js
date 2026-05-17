import { ref, onMounted } from 'vue'

import { dashboardService } from '../services/dashboard.service'

export function useDashboard() {

    const stats = ref(null)

    const recentBookings = ref([])

    const loading = ref(false)

    const fetchDashboard = async () => {

        loading.value = true

        try {

            const [
                statsResponse,
                bookingsResponse,
            ] = await Promise.all([
                dashboardService.getStats(),
                dashboardService.getRecentBookings(),
            ])

            stats.value = statsResponse.data

            recentBookings.value = bookingsResponse.data

        } catch (error) {

            console.error(error)

        } finally {

            loading.value = false
        }
    }

    onMounted(fetchDashboard)

    return {
        stats,
        recentBookings,
        loading,
    }
}