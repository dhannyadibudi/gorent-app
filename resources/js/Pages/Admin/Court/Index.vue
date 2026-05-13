<script setup>
defineProps({
    courts: Object
})
</script>

<template>

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            Court Management
        </h1>

        <div
            v-for="court in courts.data"
            :key="court.id"
            class="border p-4 rounded mb-2"
        >

            <div class="font-bold">
                {{ court.name }}
            </div>

            <div>
                {{ court.gor.name }}
            </div>

            <div>
                Rp {{ court.price_per_hour }}
            </div>

        </div>

    </div>

</template>