<script setup>
import Select from 'primevue/select'

import BaseField from './BaseField.vue'

defineProps({
    label: String,
    error: String,
    required: Boolean,
    options: Array,
    optionLabel: String,
    optionValue: String,
})
</script>

<template>

    <BaseField
        :label="label"
        :error="error"
        :required="required"
    >

        <Select
            :options="options"
            :optionLabel="optionLabel"
            :optionValue="optionValue"
            class="w-full"
            v-bind="$attrs"
        />

    </BaseField>

</template>