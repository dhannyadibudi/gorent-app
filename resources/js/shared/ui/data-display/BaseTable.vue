<script setup>
import DataTable from 'primevue/datatable'

defineProps({
    value: {
        type: Array,
        default: () => [],
    },

    loading: {
        type: Boolean,
        default: false,
    },

    rows: {
        type: Number,
        default: 10,
    },
})
</script>

<template>

    <DataTable
        :value="value"
        :loading="loading"
        :rows="rows"
        paginator
        stripedRows
        removableSort
        responsiveLayout="scroll"
        tableStyle="min-width: 100%"
        class="rounded-2xl overflow-hidden"
    >

        <slot />

        <template #empty>

            <slot name="empty">

                <div class="py-10">

                    No data available.

                </div>

            </slot>

        </template>

    </DataTable>

</template>