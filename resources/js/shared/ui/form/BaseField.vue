<script setup>
defineProps({
    label: String,
    error: String,
    required: Boolean,
})
</script>

<template>

    <div class="flex flex-col gap-2">

        <label
            v-if="label"
            class="
                text-sm
                font-medium
                text-gray-700
            "
        >

            {{ label }}

            <span
                v-if="required"
                class="text-red-500"
            >
                *
            </span>

        </label>

        <slot />

        <small
            v-if="error"
            class="text-sm text-red-500"
        >
            {{ error }}
        </small>

    </div>

</template>