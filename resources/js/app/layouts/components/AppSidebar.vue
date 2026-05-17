<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

import { adminMenus } from '@/constants/menu'

const page = usePage()

const currentPath = computed(() => page.url)

const isActiveMenu = (href) => {
    return currentPath.value.startsWith(href)
}
</script>

<template>

    <aside
        class="
            fixed
            left-0
            top-0
            z-40
            flex
            h-screen
            w-72
            flex-col
            border-r
            bg-white
            px-4
            py-6
        "
    >

        <!-- Logo -->
        <div class="mb-10 px-2">

            <h1 class="text-2xl font-bold text-gray-900">
                GoRent
            </h1>

            <p class="text-sm text-gray-500">
                Admin Dashboard
            </p>

        </div>

        <!-- Menu -->
        <div class="flex flex-1 flex-col gap-2">

            <Link
                v-for="menu in adminMenus"
                :key="menu.href"
                :href="menu.href"
                class="
                    flex
                    items-center
                    gap-3
                    rounded-xl
                    px-4
                    py-3
                    text-sm
                    font-medium
                    transition-all
                    duration-200
                "
                :class="
                    isActiveMenu(menu.href)
                        ? 'bg-black text-white shadow-sm'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-black'
                "
            >

                <i
                    :class="menu.icon"
                    class="text-base"
                />

                <span>
                    {{ menu.label }}
                </span>

            </Link>

        </div>

    </aside>

</template>