<script setup>
import StatCard from '@/shared/ui/data-display/StatCard.vue'

import { formatCurrency } from '@/helpers/currency'

defineProps({
    revenue: Number,
})
</script>

<template>

    <StatCard
        title="Revenue"
        :value="formatCurrency(revenue)"
        icon="pi pi-wallet"
    />

</template>