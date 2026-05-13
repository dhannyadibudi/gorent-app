<script setup>
import { router } from '@inertiajs/vue3'
</script>

<template>

    <header
        class="
            h-16
            bg-white
            border-b
            px-6
            flex
            items-center
            justify-between
        "
    >

        <div>

            <h2 class="font-semibold text-lg">
                Admin Dashboard
            </h2>

        </div>

        <button
            @click="router.post('/logout')"
            class="
                px-4
                py-2
                rounded-lg
                bg-black
                text-white
            "
        >
            Logout
        </button>

    </header>

</template>