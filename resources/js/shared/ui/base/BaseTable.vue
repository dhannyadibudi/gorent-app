<script setup>
import DataTable from 'primevue/datatable'

defineProps({
    value: Array,
    loading: Boolean,
})
</script>

<template>
    <DataTable
        :value="value"
        :loading="loading"
        paginator
        :rows="10"
        responsiveLayout="scroll"
        stripedRows
    >
        <slot />
    </DataTable>
</template>