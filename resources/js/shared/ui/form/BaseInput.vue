<script setup>
import InputText from 'primevue/inputtext'

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

        <InputText
            class="w-full"
            v-bind="$attrs"
        />

    </BaseField>

</template>