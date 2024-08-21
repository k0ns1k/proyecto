<template>
    <div class="mx-auto max-w-lg mt-10">
        <div class="shadow-lg border rounded-lg p-6">
            <form
                class="space-y-6"
                @submit.prevent="authentication.do_recovery"
            >
                <div>
                    <label
                        for="email"
                        :class="[
                            authentication.recovery.invalid('email')
                                ? 'text-red-900'
                                : 'text-gray-900',
                        ]"
                        class="block text-sm font-medium leading-6"
                        >Email address</label
                    >
                    <div class="mt-2">
                        <input
                            id="email"
                            v-model="authentication.recovery.email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            :class="[
                                authentication.recovery.invalid('email')
                                    ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600'
                                    : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600',
                            ]"
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                            @change="authentication.recovery.validate('email')"
                        />
                    </div>
                </div>
                <div>
                    <button
                        :disabled="authentication.recovery.processing"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Confirm
                    </button>
                </div>
                <p class="mt-10 text-center text-sm text-gray-500">
                    Already remember?
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
    authentication.recovery.reset();
    authentication.recovery.forgetError("email");
});
</script>
