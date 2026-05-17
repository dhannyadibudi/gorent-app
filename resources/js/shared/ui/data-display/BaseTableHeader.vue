<script setup>
defineProps({
    title: String,
    description: String,
})
</script>

<template>

    <div
        class="
            mb-5
            flex
            items-center
            justify-between
        "
    >

        <div>

            <h2
                class="
                    text-xl
                    font-semibold
                    text-gray-900
                "
            >
                {{ title }}
            </h2>

            <p
                class="
                    mt-1
                    text-sm
                    text-gray-500
                "
            >
                {{ description }}
            </p>

        </div>

        <div>

            <slot />

        </div>

    </div>

</template>