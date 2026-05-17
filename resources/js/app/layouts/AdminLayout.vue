<script setup>
import AppSidebar from './components/AppSidebar.vue'
import AppTopbar from './components/AppTopbar.vue'
</script>

<template>

    <div class="min-h-screen bg-gray-50">

        <AppSidebar />

        <div class="ml-72">

            <AppTopbar />

            <main class="p-6">

                <slot />

            </main>

        </div>

    </div>

</template>