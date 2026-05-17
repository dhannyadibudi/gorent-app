<script setup>
import StatCard from '@/shared/ui/data-display/StatCard.vue'

defineProps({
    totalBookings: Number,
})
</script>

<template>

    <StatCard
        title="Total Bookings"
        :value="totalBookings"
        icon="pi pi-ticket"
    />

</template>