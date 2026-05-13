<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import { Link, router } from '@inertiajs/vue3'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import Tag from 'primevue/tag'

defineOptions({
    layout: AdminLayout,
})

defineProps({
    gors: Object,
})

const destroy = (id) => {

    if (!confirm('Delete this GOR?')) {
        return
    }

    router.delete(`/admin/gors/${id}`)
}
</script>

<template>

    <div>

        <div
            class="
                flex
                items-center
                justify-between
                mb-6
            "
        >

            <div>

                <h1 class="text-3xl font-bold">
                    GOR Management
                </h1>

                <p class="text-gray-500">
                    Manage all sports venues
                </p>

            </div>

            <Link href="/admin/gors/create">

                <Button
                    label="Create GOR"
                    icon="pi pi-plus"
                />

            </Link>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-4">

            <DataTable
                :value="gors.data"
                stripedRows
                paginator
                :rows="10"
                responsiveLayout="scroll"
            >

                <Column
                    field="name"
                    header="Name"
                />

                <Column
                    field="address"
                    header="Address"
                />

                <Column
                    header="Status"
                >

                    <template #body="slotProps">

                        <Tag
                            :value="
                                slotProps.data.is_active
                                    ? 'Active'
                                    : 'Inactive'
                            "
                            :severity="
                                slotProps.data.is_active
                                    ? 'success'
                                    : 'danger'
                            "
                        />

                    </template>

                </Column>

                <Column
                    header="Actions"
                    style="width: 150px"
                >

                    <template #body="slotProps">

                        <div class="flex gap-2">

                            <Link
                                :href="`/admin/gors/${slotProps.data.id}/edit`"
                            >

                                <Button
                                    icon="pi pi-pencil"
                                    severity="info"
                                    outlined
                                />

                            </Link>

                            <Button
                                icon="pi pi-trash"
                                severity="danger"
                                outlined
                                @click="destroy(slotProps.data.id)"
                            />

                        </div>

                    </template>

                </Column>

            </DataTable>

        </div>

    </div>

</template>