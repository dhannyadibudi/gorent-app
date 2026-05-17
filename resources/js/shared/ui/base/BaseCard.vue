<script setup>
import Card from 'primevue/card'
</script>

<template>
    <Card class="rounded-2xl shadow-sm">
        <template #content>
            <slot />
        </template>
    </Card>
</template>