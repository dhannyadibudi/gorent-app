<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Topbar from '@/Components/Admin/Topbar.vue'
</script>

<template>

    <div class="min-h-screen bg-gray-100 flex">

        <Sidebar />

        <div class="flex-1 flex flex-col">

            <Topbar />

            <main class="p-6">

                <slot />

            </main>

        </div>

    </div>

</template>