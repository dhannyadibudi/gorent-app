<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div
        class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 font-sans"
    >
        <div
            class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-gray-100"
        >
            <div class="text-center">
                <Link href="/">
                    <img
                        src="/images/gorent-logo.png"
                        alt="GoRent Logo"
                        class="h-16 mx-auto object-contain select-none"
                    />
                </Link>
                <h2 class="mt-6 text-2xl font-bold text-gray-900">
                    Welcome back
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Please enter your details to sign in.
                </p>
            </div>

            <div
                v-if="status"
                class="mb-4 text-sm font-medium text-green-600 text-center"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="mt-8 space-y-5">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 block">
                    <label class="flex items-center cursor-pointer">
                        <Checkbox
                            name="remember"
                            v-model:checked="form.remember"
                            class="text-[#f04a33] focus:ring-[#f04a33]"
                        />
                        <span class="ms-2 text-sm text-gray-600"
                            >Remember me</span
                        >
                    </label>
                </div>

                <div class="mt-6 flex flex-col gap-4">
                    <PrimaryButton
                        class="w-full justify-center py-3 text-base !bg-[#f04a33] hover:!bg-[#d63f29] focus:!bg-[#d63f29] active:!bg-[#c53823] transition-colors"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </PrimaryButton>

                    <div class="flex items-center justify-between mt-2 px-1">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm font-medium text-[#f04a33] hover:text-[#d63f29] no-underline focus:outline-none"
                        >
                            Forgot password?
                        </Link>

                        <span class="text-sm text-gray-500">
                            Or
                            <Link
                                :href="route('register')"
                                class="font-medium text-gray-900 hover:underline"
                            >
                                Sign up
                            </Link>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
