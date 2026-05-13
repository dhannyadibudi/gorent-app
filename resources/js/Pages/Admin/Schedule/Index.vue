<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import { useForm } from '@inertiajs/vue3'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import Select from 'primevue/select'
import DatePicker from 'primevue/datepicker'
import Tag from 'primevue/tag'
import dayjs from 'dayjs'

defineOptions({
    layout: AdminLayout,
})

const props = defineProps({
    schedules: Object,
    courts: Array,
})

const form = useForm({
    court_id: '',
    schedule_date: null,
})

const generate = () => {
    // form.post('/admin/schedules')
    form
    .transform((data) => ({
        ...data,

        schedule_date: dayjs(
            data.schedule_date
        ).format('YYYY-MM-DD'),
    }))

    .post('/admin/schedules')
}
</script>

<template>

    <div>

        <div class="mb-6">

            <h1 class="text-3xl font-bold">
                Schedule Management
            </h1>

        </div>

        <div
            class="
                bg-white
                rounded-2xl
                shadow-sm
                p-6
                mb-6
            "
        >

            <h2 class="text-xl font-semibold mb-4">
                Generate Schedule
            </h2>

            <div
                class="
                    grid
                    grid-cols-1
                    md:grid-cols-3
                    gap-4
                "
            >

                <div>

                    <label class="block mb-2">
                        Court
                    </label>

                    <Select
                        v-model="form.court_id"
                        :options="courts"
                        optionLabel="name"
                        optionValue="id"
                        class="w-full"
                        placeholder="Select Court"
                    />

                </div>

                <div>

                    <label class="block mb-2">
                        Date
                    </label>

                    <DatePicker
                        v-model="form.schedule_date"
                        class="w-full"
                        dateFormat="yy-mm-dd"
                    />

                </div>

                <div class="flex items-end">

                    <Button
                        label="Generate"
                        icon="pi pi-calendar"
                        @click="generate"
                        :loading="form.processing"
                    />

                </div>

            </div>

        </div>

        <div
            class="
                bg-white
                rounded-2xl
                shadow-sm
                p-4
            "
        >

            <DataTable
                :value="schedules.data"
                paginator
                :rows="20"
                stripedRows
            >

                <Column
                    field="court.name"
                    header="Court"
                />

                <Column
                    header="GOR"
                >

                    <template #body="slotProps">

                        {{
                            slotProps.data.court.gor.name
                        }}

                    </template>

                </Column>

                <Column header="Date">

                    <template #body="slotProps">

                        {{
                            dayjs(
                                slotProps.data.schedule_date
                            ).format('DD MMM YYYY')
                        }}

                    </template>

                </Column>

                <Column header="Start">

                    <template #body="slotProps">

                        {{
                            slotProps.data.start_time.slice(0,5)
                        }}

                    </template>

                </Column>

                <Column header="End">

                    <template #body="slotProps">

                        {{
                            slotProps.data.end_time.slice(0,5)
                        }}

                    </template>

                </Column>

                <Column
                    header="Status"
                >

                    <template #body="slotProps">

                        <Tag
                            :value="
                                slotProps.data.is_booked
                                    ? 'Booked'
                                    : 'Available'
                            "
                            :severity="
                                slotProps.data.is_booked
                                    ? 'danger'
                                    : 'success'
                            "
                        />

                    </template>

                </Column>

            </DataTable>

        </div>

    </div>

</template>