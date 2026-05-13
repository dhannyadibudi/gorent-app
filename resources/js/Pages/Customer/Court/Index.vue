<script setup>
import { router } from '@inertiajs/vue3'

import CustomerLayout from '@/Layouts/CustomerLayout.vue'

import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Card from 'primevue/card'

defineOptions({
    layout: CustomerLayout,
})

const props = defineProps({
    courts: Object,
    filters: Object,
})

const search = (event) => {

    router.get(
        '/courts',
        {
            search: event.target.value,
        },
        {
            preserveState: true,
            replace: true,
        }
    )
}
</script>

<template>

    <div>

        <div class="mb-8">

            <h1
                class="
                    text-4xl
                    font-bold
                    mb-2
                "
            >
                Find Your Court
            </h1>

            <p class="text-gray-500">
                Book badminton, futsal, basketball and more.
            </p>

        </div>

        <div class="mb-6 max-w-md">

            <InputText
                placeholder="Search court or GOR..."
                class="w-full"
                :defaultValue="filters.search"
                @input="search"
            />

        </div>

        <div
            class="
                grid
                grid-cols-1
                md:grid-cols-2
                lg:grid-cols-3
                gap-6
            "
        >

            <Card
                v-for="court in courts.data"
                :key="court.id"
            >

                <template #title>

                    {{ court.name }}

                </template>

                <template #subtitle>

                    {{ court.gor.name }}

                </template>

                <template #content>

                    <div class="space-y-2">

                        <div>

                            Rp
                            {{
                                Number(
                                    court.price_per_hour
                                ).toLocaleString()
                            }}
                            / hour
                        </div>

                        <div>

                            {{
                                court.open_time
                            }}

                            -

                            {{
                                court.close_time
                            }}

                        </div>

                    </div>

                </template>

                <template #footer>

                    <Button
                        label="Book Now"
                        icon="pi pi-calendar"
                        class="w-full"
                        @click="
                            router.visit(
                                `/customer/courts/${court.id}/booking`
                            )
                        "
                    />

                </template>

            </Card>

        </div>

    </div>

</template>