<template>
    <div>
        <Notifications />

        <ResponsiveSidebar v-if="authentication.is_authenticated"
                           :teams="teams" />

        <StaticSidebar v-if="authentication.is_authenticated"
                       :teams="teams" />

        <div :class="[authentication.is_authenticated ? 'lg:pl-72' : '' ]">
            <div v-if="authentication.is_authenticated"
                 class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="navigation.open">
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <!-- Separator -->
                <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true" />
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <Search />
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <NotificationDropdown />
                        <!-- Separator -->
                        <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10" aria-hidden="true" />
                        <UserDropdown />
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <router-view v-slot="{ Component, route }">
                        <div :key="route.name">
                            <Component :is="Component" />
                        </div>
                    </router-view>
                </div>
            </main>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {
    Bars3Icon,
} from '@heroicons/vue/24/outline'

import StaticSidebar from "@/components/Shared/StaticSidebar.vue";
import ResponsiveSidebar from "@/components/Shared/ResponsiveSidebar.vue";
import UserDropdown from "@/components/Shared/UserDropdown.vue";
import NotificationDropdown from "@/components/Shared/NotificationDropdown.vue";
import Search from "@/components/Shared/Search.vue";
import { useNavigation } from "@/stores/navigation.ts";
import Notifications from "@/components/Shared/Notifications.vue";
import { useAuthentication } from "@/stores/authentication.ts";

const teams = [
    { id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false },
    { id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false },
    { id: 3, name: 'Workcation', href: '#', initial: 'W', current: false },
];

const navigation = useNavigation();
const authentication = useAuthentication();

</script>
