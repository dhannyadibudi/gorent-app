<script setup>
import Dialog from 'primevue/dialog'

defineProps({
    visible: Boolean,
    title: String,
})
</script>

<template>
    <Dialog
        :visible="visible"
        modal
        :header="title"
        class="w-full max-w-xl"
    >
        <slot />

        <template #footer>
            <slot name="footer" />
        </template>
    </Dialog>
</template>