<script setup>
import InputText from 'primevue/inputtext'

defineProps({
    label: String,
    error: String,
})
</script>

<template>
    <div class="flex flex-col gap-2">
        <label
            v-if="label"
            class="text-sm font-medium"
        >
            {{ label }}
        </label>

        <InputText
            class="w-full"
            v-bind="$attrs"
        />

        <small
            v-if="error"
            class="text-red-500"
        >
            {{ error }}
        </small>
    </div>
</template>