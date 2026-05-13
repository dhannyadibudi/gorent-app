<script setup>
import dayjs from 'dayjs'

import CustomerLayout from '@/Layouts/CustomerLayout.vue'

import { useForm, router } from '@inertiajs/vue3'

import Button from 'primevue/button'
import DatePicker from 'primevue/datepicker'
import Tag from 'primevue/tag'

defineOptions({
    layout: CustomerLayout,
})

const props = defineProps({
    court: Object,
    selectedDate: String,
})

const dateForm = useForm({
    date: props.selectedDate,
})

const bookingForm = useForm({
    schedule_id: null,
})

const changeDate = () => {

    router.get(
        `/customer/courts/${props.court.id}/booking`,
        {
            date: dayjs(
                dateForm.date
            ).format('YYYY-MM-DD')
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    )
}

const booking = (scheduleId) => {

    bookingForm.schedule_id = scheduleId

    bookingForm.post('/customer/bookings')
}
</script>

<template>

    <div>

        <div class="mb-6">

            <h1 class="text-3xl font-bold">
                Booking Court
            </h1>

            <p class="text-gray-500">
                {{ court.name }}
            </p>

        </div>

        <div
            class="
                bg-white
                rounded-2xl
                p-6
                shadow-sm
                mb-6
            "
        >

            <div class="max-w-sm">

                <label class="block mb-2">
                    Select Date
                </label>

                <DatePicker
                    v-model="dateForm.date"
                    class="w-full"
                    dateFormat="yy-mm-dd"
                    @date-select="changeDate"
                />

            </div>

        </div>

        <div
            class="
                grid
                grid-cols-2
                md:grid-cols-4
                gap-4
            "
        >

            <div
                v-for="schedule in court.schedules"
                :key="schedule.id"
                class="
                    bg-white
                    rounded-2xl
                    p-4
                    shadow-sm
                    border
                "
            >

                <div class="mb-3">

                    <div class="font-bold text-lg">

                        {{ schedule.start_time.slice(0,5) }}

                        -

                        {{ schedule.end_time.slice(0,5) }}

                    </div>

                </div>

                <div class="mb-4">

                    <Tag
                        :value="
                            schedule.is_booked
                                ? 'Booked'
                                : 'Available'
                        "
                        :severity="
                            schedule.is_booked
                                ? 'danger'
                                : 'success'
                        "
                    />

                </div>

                <Button
                    v-if="!schedule.is_booked"
                    label="Book Now"
                    icon="pi pi-check"
                    class="w-full"
                    @click="booking(schedule.id)"
                />

            </div>

        </div>

    </div>

</template>