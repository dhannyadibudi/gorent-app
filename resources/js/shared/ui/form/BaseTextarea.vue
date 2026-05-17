<script setup>
import Textarea from 'primevue/textarea'

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

        <Textarea
            rows="5"
            autoResize
            class="w-full"
            v-bind="$attrs"
        />

    </BaseField>

</template>