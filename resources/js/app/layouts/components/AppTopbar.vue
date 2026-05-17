<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user = page.props.auth.user
</script>

<template>

    <header
        class="
            sticky
            top-0
            z-30
            flex
            h-16
            items-center
            justify-between
            border-b
            bg-white
            px-6
        "
    >

        <div>

            <h2 class="text-lg font-semibold text-gray-900">
                Admin Panel
            </h2>

        </div>

        <div
            class="
                flex
                items-center
                gap-3
            "
        >

            <div
                class="
                    flex
                    h-10
                    w-10
                    items-center
                    justify-center
                    rounded-full
                    bg-black
                    text-sm
                    font-semibold
                    text-white
                "
            >
                {{ user.name.charAt(0) }}
            </div>

            <div>

                <p class="text-sm font-medium">
                    {{ user.name }}
                </p>

                <p class="text-xs text-gray-500">
                    Administrator
                </p>

            </div>

        </div>

    </header>

</template>