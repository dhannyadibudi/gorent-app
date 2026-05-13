<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    gor: '',
    name: '',
    description: '',
    price_per_hour: '',
    open_time: '',
    close_time: '',
    is_active: true,
})

const submit = () => {
    form.post('/admin/gors')
}
</script>

<template>
    <div class="p-6 max-w-xl">

        <h1 class="text-2xl font-bold mb-6">
            Create GOR
        </h1>

        <form
            @submit.prevent="submit"
            class="space-y-4"
        >

            <input
                v-model="form.name"
                type="text"
                placeholder="Court Name"
                class="border p-2 w-full rounded"
            />

            <input
                v-model="form.address"
                type="text"
                placeholder="Address"
                class="border p-2 w-full rounded"
            />

            <input
                type="file"
                @input="form.thumbnail = $event.target.files[0]"
            />

            <label class="flex items-center gap-2">

                <input
                    v-model="form.is_active"
                    type="checkbox"
                />

                Active

            </label>

            <button
                type="submit"
                class="bg-black text-white px-4 py-2 rounded"
            >
                Save
            </button>

        </form>

    </div>
</template>