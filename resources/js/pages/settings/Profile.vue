<template>
    <div v-if="authentication.loaded" class="divide-y divide-white/5">
        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-800">Personal Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>
            <form class="md:col-span-2" @submit.prevent="authentication.do_change_profile">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
                    <div class="col-span-full flex items-center gap-x-8">
                        <img v-if="authentication.user.photo"
                            :src="`/avatars/${authentication.user.photo}`" alt="" class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover" />
                        <Gravatar v-else
                                  :email="authentication.user.email"
                                  class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover"
                                  :alt="authentication.user.name"
                                  default="mp"
                                  :size="80"
                                  rating="g"
                        />
                        <div>
                            <input class="text-gray-700 " type="file" name="photo" @change="(e) => { authentication.change_profile.photo = e.target.files[0] }">
                            <p class="mt-2 text-xs leading-5 text-gray-600">JPG, GIF or PNG. 1MB max.</p>
                        </div>
                    </div>
                    <div class="sm:col-span-full">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-700">Name</label>
                        <div class="mt-2">
                            <input type="text"
                                   v-model="authentication.user.name"
                                   name="name"
                                   id="name"
                                   autocomplete="given-name"
                                   readonly
                                   class="block w-full rounded-md border bg-white/5 py-1.5 text-gray shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Email address</label>
                        <div class="mt-2">
                            <input id="email"
                                   v-model="authentication.user.email"
                                   name="email"
                                   type="email"
                                   autocomplete="email"
                                   readonly
                                   class="block w-full rounded-md border bg-white/5 py-1.5 text-gray shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex">
                    <button :disabled="authentication.change_profile.processing"
                            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                </div>
            </form>
        </div>







    </div>
</template>

<script lang="ts" setup>

import { useAuthentication } from "@/stores/authentication.ts";
import { Gravatar } from "@sauromates/vue-gravatar";

const authentication = useAuthentication();

</script>
