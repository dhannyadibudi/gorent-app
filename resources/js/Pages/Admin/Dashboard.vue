<script setup>
import AdminLayout from '@/app/layouts/AdminLayout.vue'

import DashboardHeader from '@/features/admin/dashboard/components/DashboardHeader.vue'
import DashboardGrid from '@/features/admin/dashboard/components/DashboardGrid.vue'

import BookingStatsWidget from '@/features/admin/dashboard/widgets/BookingStatsWidget.vue'
import RevenueWidget from '@/features/admin/dashboard/widgets/RevenueWidget.vue'
import RecentBookingsWidget from '@/features/admin/dashboard/widgets/RecentBookingsWidget.vue'

import { useDashboard } from '@/features/admin/dashboard/composables/useDashboard'

const {
    stats,
    recentBookings,
} = useDashboard()
</script>

<template>

    <AdminLayout>

        <DashboardHeader />

        <DashboardGrid v-if="stats">

            <BookingStatsWidget
                :totalBookings="stats.total_bookings"
            />

            <RevenueWidget
                :revenue="stats.total_revenue"
            />

        </DashboardGrid>

        <div class="mt-6">

            <RecentBookingsWidget
                :bookings="recentBookings"
            />

        </div>

    </AdminLayout>

</template>