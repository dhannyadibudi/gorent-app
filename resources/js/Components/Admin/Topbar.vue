<script setup>
import { router } from '@inertiajs/vue3'
import Button from 'primevue/button';
</script>

<template>

    <header
        class="
            h-16
            bg-black
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

        <Button
            label="Logout"
            @click="router.post('/logout')"
            severity="danger" 
            
        />
    </header>

</template>