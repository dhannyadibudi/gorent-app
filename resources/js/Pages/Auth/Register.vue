<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

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
                    Create an account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Join GoRent to start booking courts.
                </p>
            </div>

            <form @submit.prevent="submit" class="mt-8 space-y-5">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        placeholder="Email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="phone" value="Phone Number" />
                    <TextInput
                        id="phone"
                        type="tel"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.phone"
                        required
                        placeholder="Phone number"
                    />
                    <InputError class="mt-2" :message="form.errors.phone" />
                </div>

                <div>
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="Create a password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full focus:border-[#f04a33] focus:ring-[#f04a33]"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Repeat your password"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="mt-6 flex flex-col gap-4">
                    <PrimaryButton
                        class="w-full justify-center py-3 text-base !bg-gray-900 hover:!bg-gray-800 focus:!bg-gray-800 active:!bg-gray-950 transition-colors"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Sign up
                    </PrimaryButton>

                    <div class="text-center mt-2">
                        <span class="text-sm text-gray-500">
                            Already have an account?
                            <Link
                                :href="route('login')"
                                class="font-medium text-[#f04a33] hover:underline"
                            >
                                Log in
                            </Link>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
