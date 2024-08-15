<template>
    <div>
        <ResponsiveSidebar :opened="sidebarOpen"
                           :teams="teams"
                           :links="navigation"
                           @close="sidebarOpen = false" />

        <StaticSidebar :teams="teams"
                       :links="navigation" />

        <div class="lg:pl-72">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
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
                    <!-- Your content -->
                </div>
            </main>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import {
    Bars3Icon,
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline'

import StaticSidebar from "@/components/Shared/StaticSidebar.vue";
import ResponsiveSidebar from "@/components/Shared/ResponsiveSidebar.vue";
import UserDropdown from "@/components/Shared/UserDropdown.vue";
import NotificationDropdown from "@/components/Shared/NotificationDropdown.vue";
import Search from "@/components/Shared/Search.vue";

const navigation = [
    { name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
    { name: 'Team', href: '#', icon: UsersIcon, current: false },
    { name: 'Projects', href: '#', icon: FolderIcon, current: false },
    { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
    { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
];
const teams = [
    { id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false },
    { id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false },
    { id: 3, name: 'Workcation', href: '#', initial: 'W', current: false },
];


const sidebarOpen = ref(false)
</script>
