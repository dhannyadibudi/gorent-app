<script setup>
import dayjs from 'dayjs'
import { router } from '@inertiajs/vue3'

import CustomerLayout from '@/Layouts/CustomerLayout.vue'

import Card from 'primevue/card'
import Tag from 'primevue/tag'
import Button from 'primevue/button'

defineOptions({
    layout: CustomerLayout,
})

defineProps({
    bookings: Object,
})

const paymentSeverity = (status) => {

    if (status === 'paid') {
        return 'success'
    }

    if (status === 'expired') {
        return 'danger'
    }

    return 'warn'
}
</script>

<template>

    <div class="space-y-6">
        <div
            v-if="bookings.data.length === 0"
            class="
                bg-white
                rounded-2xl
                p-12
                text-center
                shadow-sm
            "
        >

            <i
                class="
                    pi pi-calendar
                    text-5xl
                    text-gray-300
                    mb-4
                "
            />

            <h2
                class="
                    text-2xl
                    font-bold
                    mb-2
                "
            >
                No bookings yet
            </h2>

            <p class="text-gray-500">
                Start booking your favorite court.
            </p>

        </div>
        <div class="mb-8">

            <h1
                class="
                    text-4xl
                    font-bold
                "
            >
                My Bookings
            </h1>

        </div>

        <div class="space-y-6">

            <Card
                v-for="booking in bookings.data"
                :key="booking.id"
                class="
                    shadow-md
                    rounded-2xl
                    border
                    border-gray-200
                "
            >

                <template #content>

                    <div
                        class="
                            flex
                            flex-col
                            md:flex-row
                            justify-between
                            items-start
                            gap-6
                        "
                    >

                        <div class="space-y-3">

                            <div>

                                <div class="text-gray-500">
                                    Invoice
                                </div>

                                <div class="font-bold">
                                    {{
                                        booking.invoice_number
                                    }}
                                </div>

                            </div>

                            <div>

                                <div class="text-gray-500">
                                    Court
                                </div>

                                <div class="font-bold">

                                    {{
                                        booking.schedule.court.name
                                    }}

                                    -
                                    
                                    {{
                                        booking.schedule.court.gor.name
                                    }}

                                </div>

                            </div>

                            <div>

                                <div class="text-gray-500">
                                    Date
                                </div>

                                <div class="font-bold">

                                    {{
                                        dayjs(
                                            booking.schedule.schedule_date
                                        ).format(
                                            'DD MMM YYYY'
                                        )
                                    }}

                                </div>

                            </div>

                        </div>

                        <div
                            class="
                                flex
                                flex-col
                                items-end
                                gap-3
                            "
                        >

                            <Tag
                                :value="
                                    booking.payment?.status ?? 'pending'
                                "
                                :severity="
                                    paymentSeverity(
                                        booking.payment?.status ?? 'pending'
                                    )
                                "
                            />

                            <div
                                class="
                                    text-2xl
                                    font-bold
                                "
                            >

                                Rp

                                {{
                                    Number(
                                        booking.total_price
                                    ).toLocaleString()
                                }}

                            </div>

                            <Button
                                label="View Payment"
                                icon="pi pi-wallet"
                                @click="
                                    router.visit(
                                        `/customer/bookings/${booking.id}/payment`
                                    )
                                "
                            />

                        </div>

                    </div>

                </template>

            </Card>

        </div>

    </div>

</template>