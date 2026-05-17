<script setup>
import Column from 'primevue/column'

import BaseTable from '@/shared/ui/data-display/BaseTable.vue'
import StatusTag from '@/shared/ui/feedback/StatusTag.vue'

import { bookingColumns } from './booking.columns'

defineProps({
    bookings: Array,
    loading: Boolean,
})
</script>

<template>

    <BaseTable
        :value="bookings"
        :loading="loading"
    >

        <Column
            v-for="column in bookingColumns"
            :key="column.field"
            :field="column.field"
            :header="column.header"
            sortable
        >

            <template
                v-if="column.field === 'status'"
                #body="{ data }"
            >

                <StatusTag
                    :status="data.status"
                />

            </template>

        </Column>

    </BaseTable>

</template>