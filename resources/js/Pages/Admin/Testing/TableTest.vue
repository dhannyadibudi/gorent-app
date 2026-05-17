<script setup>
import Column from 'primevue/column'

import AdminLayout from '@/app/layouts/AdminLayout.vue'

import BaseTable from '@/shared/ui/data-display/BaseTable.vue'
import BaseTableHeader from '@/shared/ui/data-display/BaseTableHeader.vue'
import StatusTag from '@/shared/ui/feedback/StatusTag.vue'
import BaseButton from '@/shared/ui/base/BaseButton.vue'

const bookings = [
    {
        id: 1,
        customer: 'John Doe',
        status: 'paid',
        total: 150000,
    },
]
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

        <BaseTable :value="bookings">

            <Column
                field="customer"
                header="Customer"
            />

            <Column
                field="total"
                header="Total"
            />

            <Column header="Status">

                <template #body="{ data }">

                    <StatusTag
                        :status="data.status"
                    />

                </template>

            </Column>

        </BaseTable>

    </AdminLayout>

</template>