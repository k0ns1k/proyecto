<template>
    <Menu as="div" class="relative">
        <MenuButton class="-m-1.5 flex items-center p-1.5">
            <span class="sr-only">Open user menu</span>
            <img
                v-if="authentication.user.photo"
                class="h-8 w-8 rounded-full bg-gray-50"
                :src="`/avatars/${authentication.user.photo}`"
                alt=""
            />
            <Gravatar
                v-else
                :email="authentication.user.email"
                class="h-8 w-8 rounded-full bg-gray-50"
                :alt="authentication.user.name"
                default="mp"
                :size="80"
                rating="g"
            />
            <span class="hidden lg:flex lg:items-center">
                <span
                    class="ml-4 text-sm font-semibold leading-6 text-gray-900"
                    aria-hidden="true"
                    >{{ authentication.user.name }}</span
                >
                <ChevronDownIcon
                    class="ml-2 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </span>
        </MenuButton>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <MenuItems
                class="absolute right-0 z-50 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
            >
                <MenuItem v-slot="{ active }">
                    <router-link
                        :to="`/profile/${authentication.user.id}`"
                        :class="[
                            active ? 'bg-gray-50' : '',
                            'block px-3 py-1 text-sm leading-6 text-gray-900',
                        ]"
                    >
                        Your Profile
                    </router-link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                    <button
                        type="button"
                        :class="[
                            active ? 'bg-gray-50' : '',
                            'block px-3 py-1 text-sm leading-6 text-gray-900',
                        ]"
                        @click="authentication.sign_out"
                    >
                        Sign out
                    </button>
                </MenuItem>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script lang="ts" setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { useAuthentication } from "@/stores/authentication.ts";
import { Gravatar } from "@sauromates/vue-gravatar";

const authentication = useAuthentication();
</script>
