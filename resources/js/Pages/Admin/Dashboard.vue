<script setup>
import dayjs from 'dayjs'

import AdminLayout from '@/Layouts/AdminLayout.vue'

import Card from 'primevue/card'
import Tag from 'primevue/tag'

defineOptions({
    layout: AdminLayout,
})

defineProps({
    stats: Object,
    recentBookings: Array,
})

const formatCurrency = (value) => {

    return Number(value)
        .toLocaleString()
}
</script>

<template>

    <div class="space-y-8">

        <div>

            <h1
                class="
                    text-4xl
                    font-bold
                "
            >
                Dashboard
            </h1>

        </div>

        <div
            class="
                grid
                grid-cols-1
                md:grid-cols-2
                xl:grid-cols-3
                gap-6
            "
        >

            <Card>

                <template #content>

                    <div class="space-y-2">

                        <div class="text-gray-500">
                            Total Revenue
                        </div>

                        <div
                            class="
                                text-3xl
                                font-bold
                            "
                        >
                            Rp
                            {{
                                formatCurrency(
                                    stats.total_revenue
                                )
                            }}
                        </div>

                    </div>

                </template>

            </Card>

            <Card>

                <template #content>

                    <div class="space-y-2">

                        <div class="text-gray-500">
                            Total Bookings
                        </div>

                        <div
                            class="
                                text-3xl
                                font-bold
                            "
                        >
                            {{
                                stats.total_bookings
                            }}
                        </div>

                    </div>

                </template>

            </Card>

            <Card>

                <template #content>

                    <div class="space-y-2">

                        <div class="text-gray-500">
                            Pending Payments
                        </div>

                        <div
                            class="
                                text-3xl
                                font-bold
                            "
                        >
                            {{
                                stats.pending_payments
                            }}
                        </div>

                    </div>

                </template>

            </Card>

        </div>

        <div>

            <h2
                class="
                    text-2xl
                    font-bold
                    mb-4
                "
            >
                Recent Bookings
            </h2>

            <div class="space-y-4">

                <Card
                    v-for="booking in recentBookings"
                    :key="booking.id"
                >

                    <template #content>

                        <div
                            class="
                                flex
                                justify-between
                                items-center
                            "
                        >

                            <div>

                                <div class="font-bold">

                                    {{
                                        booking.user.name
                                    }}

                                </div>

                                <div
                                    class="
                                        text-gray-500
                                    "
                                >

                                    {{
                                        booking.schedule.court.name
                                    }}

                                    -

                                    {{
                                        booking.schedule.court.gor.name
                                    }}

                                </div>

                            </div>

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-4
                                "
                            >

                                <div
                                    class="
                                        font-bold
                                    "
                                >

                                    Rp

                                    {{
                                        formatCurrency(
                                            booking.total_price
                                        )
                                    }}

                                </div>

                                <Tag
                                    :value="
                                        booking.payment?.status
                                    "
                                />

                            </div>

                        </div>

                    </template>

                </Card>

            </div>

        </div>

    </div>

</template>