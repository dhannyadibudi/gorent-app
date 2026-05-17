<script setup>
import DatePicker from 'primevue/datepicker'

import BaseField from './BaseField.vue'

defineProps({
    label: String,
    error: String,
    required: Boolean,
})
</script>

<template>

    <BaseField
        :label="label"
        :error="error"
        :required="required"
    >

        <DatePicker
            showIcon
            fluid
            class="w-full"
            v-bind="$attrs"
        />

    </BaseField>

</template>