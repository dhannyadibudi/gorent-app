<script setup>
import dayjs from 'dayjs'
import duration from 'dayjs/plugin/duration'
import { router } from '@inertiajs/vue3'
import { ref, computed, onMounted, onUnmounted } from 'vue'
import CustomerLayout from '@/Layouts/CustomerLayout.vue'

import Card from 'primevue/card'
import Button from 'primevue/button'
import Tag from 'primevue/tag'

dayjs.extend(duration)
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

const paymentSeverity = (status) => {
    if (status === 'paid') {
        return 'success'
    }
    if (status === 'expired') {
        return 'danger'
    }
    return 'warn'
}

const payOnline = async () => {
    const response = await fetch(
        `/customer/bookings/${props.booking.id}/snap-token`
    )
    const data = await response.json()
    window.snap.pay(
        data.snap_token,
        {
            onSuccess: function(result) {
                window.location.reload()
            },

            onPending: function(result) {
                window.location.reload()
            },

            onError: function(result) {
                window.location.reload()
            },

            onClose: function() {
                window.location.reload()
            }
        }
    )
}

const now = ref(dayjs())
let interval = null
let paymentinterval = null
const remainingTime = computed(() => {
    if (!props.booking.expired_at) {
        return '-'
    }

    const expiredAt = dayjs(
        props.booking.expired_at
    )

    const diff = expiredAt.diff(now.value)

    if (diff <= 0) {
        return 'Expired'
    }

    const durationValue =
        dayjs.duration(diff)

    const hours = String(
        durationValue.hours()
    ).padStart(2, '0')

    const minutes = String(
        durationValue.minutes()
    ).padStart(2, '0')

    const seconds = String(
        durationValue.seconds()
    ).padStart(2, '0')

    return `${hours}:${minutes}:${seconds}`

})

const checkPaymentStatus = async () => {
    const response = await fetch(
        `/customer/bookings/${props.booking.id}/status`
    )
    const data = await response.json()
    if (data.status === 'paid') {
        window.location.reload()
    }
}

onMounted(() => {
    interval = setInterval(() => {
        now.value = dayjs()
    }, 1000)

    paymentInterval = setInterval(() => {
        checkPaymentStatus()
    }, 10000)
})
onUnmounted(() => {
    clearInterval(interval)
    clearInterval(paymentInterval)
})
</script>

<template>

    <div class="max-w-2xl mx-auto">

        <Card
            class="
                shadow-md
                rounded-2xl
            "
        >

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
                                ).format(
                                    'DD MMM YYYY'
                                )
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
                                booking.payment?.status ?? 'pending'
                            "
                            :severity="
                                paymentSeverity(
                                    booking.payment?.status ?? 'pending'
                                )
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
                                booking.payment?.status === 'pending'
                            "
                            label="Pay Online"
                            icon="pi pi-credit-card"
                            severity="success"
                            class="w-full mb-3"
                            @click="payOnline"
                        />

                        <Button
                            v-if="
                                booking.payment?.status === 'pending'
                            "
                            label="Simulate Payment"
                            icon="pi pi-wallet"
                            class="w-full"
                            @click="simulatePayment"
                        />

                        <a
                            :href="`/customer/bookings/${booking.id}/invoice`"
                            target="_blank"
                            class="block mt-3"
                        >

                            <Button
                                label="Download Invoice"
                                icon="pi pi-download"
                                severity="contrast"
                                class="w-full"
                            />

                        </a>
                        <div>

                            <div class="text-black-500">
                                Payment Deadline
                            </div>

                            <div
                                class="
                                    text-red-500
                                    font-bold
                                    text-xl
                                "
                            >

                                {{ remainingTime }}

                            </div>

                        </div>
                    </div>
                </div>

            </template>
            
        </Card>

    </div>

</template>