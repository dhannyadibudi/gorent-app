<script setup>
import Button from 'primevue/button'
import { computed } from 'vue'

const props = defineProps({
    label: String,
    icon: String,
    loading: Boolean,
    variant: {
        type: String,
        default: 'primary',
    },
})

const severity = computed(() => {
    const variants = {
        primary: 'primary',
        secondary: 'secondary',
        success: 'success',
        danger: 'danger',
        contrast: 'contrast',
    }

    return variants[props.variant]
})
</script>

<template>
    <Button
        :label="label"
        :icon="icon"
        :loading="loading"
        :severity="severity"
        rounded
        v-bind="$attrs"
    >
        <slot />
    </Button>
</template>