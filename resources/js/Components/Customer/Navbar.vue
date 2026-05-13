<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'

const page = usePage()
</script>

<template>

    <header
        class="
            bg-white
            border-b
            sticky
            top-0
            z-50
        "
    >

        <div
            class="
                max-w-7xl
                mx-auto
                px-6
                h-16
                flex
                items-center
                justify-between
            "
        >

            <div class="flex items-center gap-8">

                <Link
                    href="/"
                    class="text-2xl font-bold"
                >
                    GoRent
                </Link>

                <nav class="flex items-center gap-4">

                    <Link
                        href="/courts"
                        class="hover:text-blue-500"
                    >
                        Courts
                    </Link>

                    <Link
                        href="/my-bookings"
                        class="hover:text-blue-500"
                    >
                        My Bookings
                    </Link>

                </nav>

            </div>

            <div class="flex items-center gap-4">

                <span>
                    {{
                        page.props.auth.user.name
                    }}
                </span>

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

            </div>

        </div>

    </header>

</template>