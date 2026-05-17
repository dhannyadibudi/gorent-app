<script setup>
import BaseInput from '@/shared/ui/form/BaseInput.vue'
import BaseTextarea from '@/shared/ui/form/BaseTextarea.vue'
import BaseSelect from '@/shared/ui/form/BaseSelect.vue'
import BaseFormSection from '@/shared/ui/form/BaseFormSection.vue'

defineProps({
    form: Object,
    errors: Object,
    courts: Array,
})
</script>

<template>

    <BaseFormSection
        title="Booking Information"
        description="Complete booking information."
    >

        <div class="grid grid-cols-2 gap-5">

            <BaseInput
                v-model="form.customer_name"
                label="Customer Name"
                :error="errors.customer_name"
                required
            />

            <BaseSelect
                v-model="form.court_id"
                :options="courts"
                optionLabel="name"
                optionValue="id"
                label="Court"
                :error="errors.court_id"
                required
            />

        </div>

        <div class="mt-5">

            <BaseTextarea
                v-model="form.notes"
                label="Notes"
                :error="errors.notes"
            />

        </div>

    </BaseFormSection>

</template>