<script setup>
defineProps({
    gors: Object
})
</script>

<template>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            GOR Management
        </h1>

        <div
            v-for="gor in gors.data"
            :key="gor.id"
            class="border p-4 mb-2 rounded"
        >
            {{ gor.name }}
        </div>

    </div>
</template>