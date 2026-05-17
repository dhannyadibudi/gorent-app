<script setup>
import Skeleton from 'primevue/skeleton'

defineProps({
    rows: {
        type: Number,
        default: 5,
    },
})
</script>

<template>

    <div class="space-y-3">

        <Skeleton
            width="100%"
            height="3rem"
        />

        <div
            v-for="n in rows"
            :key="n"
        >
            <Skeleton
                width="100%"
                height="4rem"
            />
        </div>

    </div>

</template>