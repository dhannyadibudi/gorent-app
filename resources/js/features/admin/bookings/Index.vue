<script setup>
import AdminLayout from '@/app/layouts/AdminLayout.vue'

import BaseTableHeader from '@/shared/ui/data-display/BaseTableHeader.vue'
import BaseButton from '@/shared/ui/base/BaseButton.vue'

import BookingTable from '@/features/admin/bookings/tables/BookingTable.vue'
import BookingFilters from '@/features/admin/bookings/components/BookingFilters.vue'

import { useBookings } from '@/features/admin/bookings/composables/useBookings'

const {
    bookings,
    loading,
    filters,
} = useBookings()
</script>

<template>

    <AdminLayout>

        <BaseTableHeader
            title="Booking Management"
            description="Manage all booking transactions."
        >

            <BaseButton
                label="Create Booking"
                icon="pi pi-plus"
            />

        </BaseTableHeader>

        <BookingFilters
            :filters="filters"
        />

        <BookingTable
            :bookings="bookings"
            :loading="loading"
        />

    </AdminLayout>

</template>