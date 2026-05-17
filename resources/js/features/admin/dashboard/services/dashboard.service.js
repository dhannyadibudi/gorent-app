import http from '@/services/http'

export const dashboardService = {

    async getStats() {

        const response = await http.get('/admin/dashboard/stats')

        return response.data
    },

    async getRecentBookings() {

        const response = await http.get('/admin/dashboard/recent-bookings')

        return response.data
    },
}