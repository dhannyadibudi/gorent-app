<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Button from "primevue/button"; 

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome to GoRent" />

    <div
        class="min-h-screen flex items-center justify-center relative bg-gray-950 overflow-hidden font-sans"
    >
        <div
            class="absolute inset-0 bg-cover bg-center z-0 transform scale-105 filter blur-[0.5px]"
            style="
                /* TODO: change background pict */
                /* background-image: url(&quot;https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?q=80&w=1920&quot;); */
            "
        ></div>

        <div class="absolute inset-0 bg-black/45 z-10"></div>

        <div
            class="relative z-20 w-full max-w-md mx-4 p-10 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl text-center border border-white/20 animate-fadein"
        >
            <div class="flex flex-col items-center justify-center mb-12">
                <!-- V1 -->
                <h1
                    class="text-5xl font-black tracking-tight flex items-center select-none m-0 text-gray-950"
                >
                    <span class="flex flex-col items-center relative">
                        Go
                        <span
                            class="text-2xl mt-[-6px] ml-8 rotate-12 drop-shadow-sm"
                            >🏸</span
                        >
                    </span>
                    <span class="text-[#f04a33] ml-0">Rent</span>
                </h1>
                <!-- V2 -->
                <!-- <h1
                    class="text-5xl font-black tracking-tight flex items-center justify-center select-none m-0 text-gray-950"
                >
                    <span
                        class="inline-flex flex-col items-center justify-center relative leading-none"
                    >
                        <span>Go</span>
                        <span
                            class="text-2xl mt-[-4px] ml-7 rotate-12 drop-shadow-sm select-none"
                            >🏸</span
                        >
                    </span>

                    <span class="text-[#f04a33] ml-0 self-start pt-[2px]"
                        >Rent</span
                    >
                </h1> -->
                <p
                    class="text-gray-600 text-xs font-bold mt-4 tracking-widest uppercase"
                >
                    Court Booking Platform
                </p>
            </div>

            <div v-if="canLogin" class="flex flex-col gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="w-full no-underline"
                >
                    <Button
                        label="Go to Dashboard"
                        icon="pi pi-home"
                        class="w-full py-3 text-base font-bold text-white bg-gray-950 border-none hover:bg-gray-800 transition-colors duration-200 rounded-lg shadow-md"
                    />
                </Link>

                <template v-else>
                    <Link :href="route('login')" class="w-full no-underline">
                        <Button
                            label="Login"
                            class="w-full py-3 text-base font-bold text-white bg-gray-950 border-none hover:bg-gray-800 transition-colors duration-200 rounded-lg shadow-md"
                        />
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="w-full no-underline"
                    >
                        <Button
                            label="Register"
                            class="w-full py-3 text-base font-bold text-white bg-[#f04a33] border-none hover:bg-[#d63f29] transition-colors duration-200 rounded-lg shadow-md"
                        />
                    </Link>
                </template>
            </div>

            <div
                class="mt-10 text-[10px] text-gray-500 font-medium tracking-wider uppercase opacity-70"
            >
                GoRent v1.0 • Laravel v{{ laravelVersion }} (PHP v{{
                    phpVersion
                }})
            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-fadein {
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.no-underline {
    text-decoration: none;
    display: block;
}
</style>
