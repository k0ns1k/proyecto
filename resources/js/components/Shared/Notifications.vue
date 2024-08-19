<template>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive" class="pointer-events-none z-40 fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end mt-14">
            <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
            <transition v-for="event in notifications.events"
                        :key="event.id"
                        enter-active-class="transform ease-out duration-300 transition"
                        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                        leave-active-class="transition ease-in duration-100"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0">
                <div v-if="event.visible" class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="ml-1 w-0 flex-1 pt-0.5">
                                <p class="text-md font-bold "
                                   :class="[event.type === 'warning'? 'text-yellow-900' : (event.type === 'error' ? 'text-red-900' : 'text-green-900')]">
                                    {{ event.tittle }}
                                </p>
                                <p class="mt-1 text-md text-gray-500">{{ event.body }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { CheckCircleIcon } from '@heroicons/vue/24/outline'
import { XMarkIcon } from '@heroicons/vue/20/solid'
import {useNotifications} from "@/stores/notifications.ts";

const notifications = useNotifications();
</script>
