<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import { useForm } from '@inertiajs/vue3'

import InputText from 'primevue/inputtext'
import Textarea from 'primevue/textarea'
import Button from 'primevue/button'
import Checkbox from 'primevue/checkbox'

defineOptions({
    layout: AdminLayout,
})

const form = useForm({
    name: '',
    description: '',
    address: '',
    thumbnail: null,
    is_active: true,
})

const submit = () => {
    form.post('/admin/gors')
}
</script>

<template>

    <div class="max-w-3xl">

        <div class="mb-6">

            <h1 class="text-3xl font-bold">
                Create GOR
            </h1>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <form
                @submit.prevent="submit"
                class="space-y-6"
            >

                <div class="space-y-2">

                    <label class="font-medium">
                        Name
                    </label>

                    <InputText
                        v-model="form.name"
                        class="w-full"
                    />

                </div>

                <div class="space-y-2">

                    <label class="font-medium">
                        Description
                    </label>

                    <Textarea
                        v-model="form.description"
                        rows="5"
                        class="w-full"
                    />

                </div>

                <div class="space-y-2">

                    <label class="font-medium">
                        Address
                    </label>

                    <InputText
                        v-model="form.address"
                        class="w-full"
                    />

                </div>

                <div class="space-y-2">

                    <label class="font-medium">
                        Thumbnail
                    </label>

                    <input
                        type="file"
                        @input="
                            form.thumbnail =
                            $event.target.files[0]
                        "
                    />

                </div>

                <div class="flex items-center gap-2">

                    <Checkbox
                        v-model="form.is_active"
                        binary
                    />

                    <label>
                        Active
                    </label>

                </div>

                <Button
                    type="submit"
                    label="Save"
                    icon="pi pi-check"
                    :loading="form.processing"
                />

            </form>

        </div>

    </div>

</template>