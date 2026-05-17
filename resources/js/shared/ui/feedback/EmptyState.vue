<script setup>
defineProps({
    title: {
        type: String,
        default: 'No Data Found',
    },

    description: {
        type: String,
        default: 'There is no available data.',
    },
})
</script>

<template>

    <div
        class="
            flex
            flex-col
            items-center
            justify-center
            rounded-2xl
            border
            border-dashed
            border-gray-300
            bg-white
            py-16
            text-center
        "
    >

        <i
            class="
                pi pi-inbox
                mb-4
                text-5xl
                text-gray-300
            "
        />

        <h3
            class="
                text-lg
                font-semibold
                text-gray-800
            "
        >
            {{ title }}
        </h3>

        <p
            class="
                mt-2
                max-w-sm
                text-sm
                text-gray-500
            "
        >
            {{ description }}
        </p>

    </div>

</template>