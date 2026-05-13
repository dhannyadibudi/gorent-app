<script setup>
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()

const menus = [
    {
        label: 'Dashboard',
        icon: 'pi pi-home',
        route: '/admin/dashboard',
    },

    {
        label: 'GOR Management',
        icon: 'pi pi-building',
        route: '/admin/gors',
    },

    {
        label: 'Court Management',
        icon: 'pi pi-map',
        route: '/admin/courts',
    },

    {
        label: 'Schedule Management',
        icon: 'pi pi-calendar',
        route: '/admin/schedules',
    },

    {
        label: 'Booking Management',
        icon: 'pi pi-ticket',
        route: '/admin/bookings',
    },
]
</script>

<template>

    <aside
        class="
            w-72
            min-h-screen
            bg-white
            border-r
            p-4
        "
    >

        <div class="mb-8">

            <h1 class="text-3xl font-bold">
                GoRent
            </h1>

            <p class="text-sm text-gray-500">
                Admin Panel
            </p>

        </div>

        <div class="space-y-2">

            <Link
                v-for="menu in menus"
                :key="menu.route"
                :href="menu.route"
                class="
                    flex
                    items-center
                    gap-3
                    px-4
                    py-3
                    rounded-xl
                    transition
                "
                :class="[
                    page.url.startsWith(menu.route)
                        ? 'bg-black text-white'
                        : 'hover:bg-gray-100'
                ]"
            >

                <i :class="menu.icon"></i>

                <span>
                    {{ menu.label }}
                </span>

            </Link>

        </div>

    </aside>

</template>