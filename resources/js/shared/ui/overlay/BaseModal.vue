<script setup>
import Dialog from 'primevue/dialog'

defineProps({
    visible: Boolean,
    title: String,
    width: {
        type: String,
        default: '40rem',
    },
})
</script>

<template>

    <Dialog
        :visible="visible"
        modal
        :header="title"
        :style="{ width }"
    >

        <slot />

        <template #footer>

            <slot name="footer" />

        </template>

    </Dialog>

</template>