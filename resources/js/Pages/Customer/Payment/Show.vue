<script setup>
import dayjs from 'dayjs'

import CustomerLayout from '@/Layouts/CustomerLayout.vue'
import { router } from '@inertiajs/vue3'
import Card from 'primevue/card'
import Button from 'primevue/button'
import Tag from 'primevue/tag'

defineOptions({
    layout: CustomerLayout,
})

const props = defineProps({
    booking: Object,
})
const simulatePayment = () => {

    router.post(
        `/customer/payments/${props.booking.payment.id}/simulate`
    )
}
</script>

<template>

    <div class="max-w-2xl mx-auto">

        <Card>

            <template #title>

                Payment

            </template>

            <template #content>

                <div class="space-y-4">

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
                                ).format('DD MMM YYYY')
                            }}

                        </div>

                    </div>

                    <div>

                        <div class="text-gray-500">
                            Time
                        </div>

                        <div class="font-bold">

                            {{
                                booking.schedule.start_time.slice(0,5)
                            }}

                            -

                            {{
                                booking.schedule.end_time.slice(0,5)
                            }}

                        </div>

                    </div>

                    <div>

                        <div class="text-gray-500">
                            Total
                        </div>

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

                    </div>

                    <div>

                        <Tag
                            :value="
                                booking.payment.status
                            "
                            :severity="
                                booking.payment.status === 'paid'
                                    ? 'success'
                                    : 'warn'
                            "
                        />

                    </div>

                    <div
                        class="
                            border-t
                            pt-4
                        "
                    >

                        <Button
                            v-if="
                                booking.payment.status !== 'paid'
                            "
                            label="Simulate Payment"
                            icon="pi pi-wallet"
                            class="w-full"
                            @click="simulatePayment"
                        />

                    </div>

                </div>

            </template>

        </Card>

    </div>

</template>