<script setup>
import Navbar from '@/Components/Customer/Navbar.vue'
</script>

<template>

    <div class="min-h-screen bg-gray-100">

        <Navbar />

        <main class="p-6 max-w-7xl mx-auto">

            <slot />

        </main>

    </div>

</template>