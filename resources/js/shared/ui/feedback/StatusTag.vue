<script setup>
import Tag from 'primevue/tag'
import { computed } from 'vue'

const props = defineProps({
    status: String,
})

const severity = computed(() => {

    const map = {
        pending: 'warning',
        paid: 'success',
        cancelled: 'danger',
        active: 'success',
        inactive: 'secondary',
    }

    return map[props.status] || 'contrast'
})
</script>

<template>

    <Tag
        :value="status"
        :severity="severity"
        rounded
        class="capitalize"
    />

</template>