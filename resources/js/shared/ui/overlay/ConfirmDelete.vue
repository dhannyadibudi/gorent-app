<script setup>
import BaseModal from './BaseModal.vue'

import BaseButton from '@/shared/ui/base/BaseButton.vue'

defineProps({
    visible: Boolean,
    loading: Boolean,
})

const emit = defineEmits([
    'confirm',
    'cancel',
])
</script>

<template>

    <BaseModal
        :visible="visible"
        title="Delete Confirmation"
        width="30rem"
    >

        <p class="text-gray-600">
            Are you sure you want to delete this data?
        </p>

        <template #footer>

            <div class="flex justify-end gap-3">

                <BaseButton
                    label="Cancel"
                    variant="secondary"
                    @click="emit('cancel')"
                />

                <BaseButton
                    label="Delete"
                    variant="danger"
                    :loading="loading"
                    @click="emit('confirm')"
                />

            </div>

        </template>

    </BaseModal>

</template>