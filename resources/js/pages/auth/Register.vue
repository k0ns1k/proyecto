<template>
    <div class="mx-auto max-w-lg">
        <div class="shadow-lg border rounded-lg p-6">
            <form
                class="space-y-6"
                @submit.prevent="authentication.do_register"
            >
                <div>
                    <label
                        for="name"
                        :class="[
                            authentication.register.invalid('name')
                                ? 'text-red-900'
                                : 'text-gray-900',
                        ]"
                        class="block text-sm font-medium leading-6"
                        >Name</label
                    >
                    <div class="mt-2">
                        <input
                            id="name"
                            v-model="authentication.register.name"
                            name="name"
                            type="text"
                            :class="[
                                authentication.register.invalid('name')
                                    ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600'
                                    : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600',
                            ]"
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                            @change="authentication.register.validate('name')"
                        />
                    </div>
                </div>
                <div>
                    <label
                        for="email"
                        :class="[
                            authentication.register.invalid('email')
                                ? 'text-red-900'
                                : 'text-gray-900',
                        ]"
                        class="block text-sm font-medium leading-6"
                        >Email address</label
                    >
                    <div class="mt-2">
                        <input
                            id="email"
                            v-model="authentication.register.email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            :class="[
                                authentication.register.invalid('email')
                                    ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600'
                                    : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600',
                            ]"
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                            @change="authentication.register.validate('email')"
                        />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label
                            for="password"
                            :class="[
                                authentication.register.invalid('password')
                                    ? 'text-red-900'
                                    : 'text-gray-900',
                            ]"
                            class="block text-sm font-medium leading-6"
                            >Password</label
                        >
                    </div>
                    <div class="mt-2">
                        <input
                            id="password"
                            v-model="authentication.register.password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            :class="[
                                authentication.register.invalid('password')
                                    ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600'
                                    : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600',
                            ]"
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                            @change="
                                authentication.register.validate('password')
                            "
                        />
                    </div>
                </div>
                <div>
                    <label
                        for="password_confirmation"
                        :class="[
                            authentication.register.invalid(
                                'password_confirmation',
                            )
                                ? 'text-red-900'
                                : 'text-gray-900',
                        ]"
                        class="block text-sm font-medium leading-6"
                        >Password confirmation</label
                    >
                    <div class="mt-2">
                        <input
                            id="password_confirmation"
                            v-model="
                                authentication.register.password_confirmation
                            "
                            name="password_confirmation"
                            type="password"
                            :class="[
                                authentication.register.invalid(
                                    'password_confirmation',
                                )
                                    ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600'
                                    : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600',
                            ]"
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                            @change="
                                authentication.register.validate(
                                    'password_confirmation',
                                )
                            "
                        />
                    </div>
                </div>

                <div>
                    <button
                        :disabled="authentication.register.processing"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Confirm
                    </button>
                </div>
                <p class="mt-10 text-center text-sm text-gray-500">
                    Already registered?
                    {{ " " }}
                    <router-link
                        to="/auth/login"
                        class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
                    >
                        Sign in
                    </router-link>
                </p>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { onUnmounted } from "vue";
import { useAuthentication } from "@/stores/authentication.ts";

const authentication = useAuthentication();

onUnmounted(() => {
    authentication.register.reset();
    authentication.register.forgetError("name");
    authentication.register.forgetError("email");
    authentication.register.forgetError("password");
});
</script>
