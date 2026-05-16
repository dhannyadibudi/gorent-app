<script setup>
import { router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({
    layout: AdminLayout
})
const props = defineProps({
    bookings: Object,
    filters: Object
})

const status = ref(props.filters.status || '')

watch(status, (value) => {
    router.get(
        route('admin.bookings.index'),
        {
            status: value
        },
        {
            preserveState: true,
            replace: true
        }
    )
})

const cancelBooking = (id) => {
    router.patch(route('admin.bookings.cancel', id))
}

const completeBooking = (id) => {
    router.patch(route('admin.bookings.complete', id))
}
</script>

<template>
    <div class="p-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">
                Booking Management
            </h1>

            <Dropdown
                v-model="status"
                :options="[
                    'pending_payment',
                    'paid',
                    'confirmed',
                    'completed',
                    'cancelled',
                    'expired'
                ]"
                placeholder="Filter Status"
                class="w-64"
            />
        </div>

        <DataTable
            :value="bookings.data"
            stripedRows
        >

            <Column
                field="invoice_number"
                header="Invoice"
            />

            <Column header="Customer">
                <template #body="{ data }">
                    {{ data.user.name }}
                </template>
            </Column>

            <Column header="GOR">
                <template #body="{ data }">
                    {{ data.court.gor.name }}
                </template>
            </Column>

            <Column header="Court">
                <template #body="{ data }">
                    {{ data.court.name }}
                </template>
            </Column>

            <Column field="booking_date" header="Date" />

            <Column field="status" header="Status">
                <template #body="{ data }">
                    <Tag
                        :value="data.status"
                    />
                </template>
            </Column>

            <Column header="Payment">
                <template #body="{ data }">
                    <Tag
                        :value="data.payment?.status"
                        severity="success"
                    />
                </template>
            </Column>

            <Column header="Action">

                <template #body="{ data }">

                    <div class="flex gap-2">

                        <Button
                            label="Detail"
                            size="small"
                            @click="
                                router.visit(
                                    route(
                                        'admin.bookings.show',
                                        data.id
                                    )
                                )
                            "
                        />

                        <Button
                            label="Cancel"
                            severity="danger"
                            size="small"
                            @click="cancelBooking(data.id)"
                        />

                        <Button
                            label="Complete"
                            severity="success"
                            size="small"
                            @click="completeBooking(data.id)"
                        />

                    </div>

                </template>

            </Column>

        </DataTable>

    </div>
</template>