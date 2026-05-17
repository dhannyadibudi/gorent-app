import http from '@/services/http'

export const bookingService = {

    async getAll(params = {}) {

        const response = await http.get('/admin/bookings', {
            params,
        })

        return response.data
    },

    async show(id) {

        const response = await http.get(`/admin/bookings/${id}`)

        return response.data
    },

    async updateStatus(id, payload) {

        const response = await http.patch(
            `/admin/bookings/${id}/status`,
            payload
        )

        return response.data
    },
}