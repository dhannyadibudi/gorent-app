<script setup>
import BaseInput from '@/shared/ui/base/BaseInput.vue'

defineProps({
    filters: Object,
})
</script>

<template>

    <div
        class="
            mb-5
            flex
            gap-4
        "
    >

        <BaseInput
            v-model="filters.search"
            placeholder="Search booking..."
        />

    </div>

</template>