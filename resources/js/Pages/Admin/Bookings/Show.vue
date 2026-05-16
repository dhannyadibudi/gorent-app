<script setup>
const props = defineProps({
    booking: Object
})
</script>

<template>

    <div class="p-6 space-y-4">

        <h1 class="text-2xl font-bold">
            Booking Detail
        </h1>

        <Card>

            <template #content>

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <p class="font-semibold">
                            Invoice
                        </p>

                        <p>
                            {{ booking.invoice_number }}
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Customer
                        </p>

                        <p>
                            {{ booking.user.name }}
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold">
                            GOR
                        </p>

                        <p>
                            {{ booking.court.gor.name }}
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Court
                        </p>

                        <p>
                            {{ booking.court.name }}
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Status
                        </p>

                        <Tag
                            :value="booking.status"
                        />
                    </div>

                    <div>
                        <p class="font-semibold">
                            Payment
                        </p>

                        <Tag
                            :value="booking.payment?.status"
                            severity="success"
                        />
                    </div>

                </div>

            </template>

        </Card>

    </div>

</template>