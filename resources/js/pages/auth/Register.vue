<template>
    <div class="mx-auto max-w-lg">
        <div class="shadow-lg border rounded-lg p-6">
            <form class="space-y-6" @submit.prevent="authentication.do_register">
                <div>
                    <label for="name"
                           :class="[authentication.register.invalid('name') ? 'text-red-900' : 'text-gray-900']"
                           class="block text-sm font-medium leading-6">Name</label>
                    <div class="mt-2">
                        <input id="name"
                               name="name"
                               type="text"
                               v-model="authentication.register.name"
                               @change="authentication.register.validate('name')"
                               :class="[authentication.register.invalid('name') ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600']"
                               class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" />
                    </div>
                </div>
                <div>
                    <label for="email"
                           :class="[authentication.register.invalid('email') ? 'text-red-900' : 'text-gray-900']"
                           class="block text-sm font-medium leading-6">Email address</label>
                    <div class="mt-2">
                        <input id="email"
                               name="email"
                               type="email"
                               v-model="authentication.register.email"
                               @change="authentication.register.validate('email')"
                               autocomplete="email"
                               :class="[authentication.register.invalid('email') ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600']"
                               class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password"
                               :class="[authentication.register.invalid('password') ? 'text-red-900' : 'text-gray-900']"
                               class="block text-sm font-medium leading-6">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               :class="[authentication.register.invalid('password') ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600']"
                               v-model="authentication.register.password"
                               @change="authentication.register.validate('password')"
                               class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" />
                    </div>
                </div>
                <div>
                    <label for="password_confirmation"
                           :class="[authentication.register.invalid('password_confirmation') ? 'text-red-900' : 'text-gray-900']"
                           class="block text-sm font-medium leading-6">Password confirmation</label>
                    <div class="mt-2">
                        <input id="password_confirmation"
                               name="password_confirmation"
                               type="password"
                               v-model="authentication.register.password_confirmation"
                               @change="authentication.register.validate('password_confirmation')"
                               :class="[authentication.register.invalid('password_confirmation') ? 'text-red-900 ring-red-300 placeholder:text-red-400 focus:ring-red-600' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600']"
                               class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <button :disabled="authentication.register.processing"
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
