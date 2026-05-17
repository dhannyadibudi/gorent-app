<script setup>
import Column from 'primevue/column'

import BaseTable from '@/shared/ui/data-display/BaseTable.vue'
import StatusTag from '@/shared/ui/feedback/StatusTag.vue'

defineProps({
    bookings: Array,
})
</script>

<template>

    <div
        class="
            rounded-2xl
            border
            bg-white
            p-5
            shadow-sm
        "
    >

        <div class="mb-5">

            <h3 class="text-lg font-semibold">
                Recent Bookings
            </h3>

        </div>

        <BaseTable :value="bookings">

            <Column
                field="invoice_number"
                header="Invoice"
            />

            <Column
                field="customer.name"
                header="Customer"
            />

            <Column header="Status">

                <template #body="{ data }">

                    <StatusTag
                        :status="data.status"
                    />

                </template>

            </Column>

        </BaseTable>

    </div>

</template>