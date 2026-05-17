<script setup>
defineProps({
    title: String,
    value: [String, Number],
    icon: String,
})
</script>

<template>

    <div
        class="
            rounded-2xl
            border
            bg-white
            p-5
            shadow-sm
        "
    >

        <div
            class="
                flex
                items-start
                justify-between
            "
        >

            <div>

                <p
                    class="
                        text-sm
                        text-gray-500
                    "
                >
                    {{ title }}
                </p>

                <h3
                    class="
                        mt-2
                        text-3xl
                        font-bold
                        text-gray-900
                    "
                >
                    {{ value }}
                </h3>

            </div>

            <div
                class="
                    flex
                    h-12
                    w-12
                    items-center
                    justify-center
                    rounded-xl
                    bg-gray-100
                "
            >

                <i
                    :class="icon"
                    class="text-xl"
                />

            </div>

        </div>

    </div>

</template>