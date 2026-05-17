<script setup>
defineProps({
    title: String,
    description: String,
})
</script>

<template>

    <div
        class="
            rounded-2xl
            border
            bg-white
            p-6
            shadow-sm
        "
    >

        <div class="mb-6">

            <h3
                class="
                    text-lg
                    font-semibold
                "
            >
                {{ title }}
            </h3>

            <p
                class="
                    text-sm
                    text-gray-500
                "
            >
                {{ description }}
            </p>

        </div>

        <slot />

    </div>

</template>