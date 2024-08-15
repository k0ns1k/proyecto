<template>
    <div class="mx-auto max-w-lg">
        <div class="shadow-lg border rounded-lg p-6">
            <form class="space-y-6" @submit.prevent="authentication.do_attempt">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email"
                               name="email"
                               type="email"
                               v-model="authentication.attempt.email"
                               @change="authentication.attempt.validate('email')"
                               autocomplete="email"
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div v-if="authentication.attempt.invalid('email')">
                        {{ authentication.attempt.errors.email }}
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               v-model="authentication.attempt.password"
                               @change="authentication.attempt.validate('password')"
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div v-if="authentication.attempt.invalid('password')">
                        {{ authentication.attempt.errors.password }}
                    </div>
                </div>

                <div>
                    <button :disabled="authentication.attempt.processing"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script lang="ts" setup>
import { useAuthentication } from "@/stores/authentication.ts";

const authentication = useAuthentication();

</script>
