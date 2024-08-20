<template>
  <div class="p-10">
    <div
      v-if="loaded"
      class="md:flex md:items-center md:justify-between md:space-x-5"
    >
      <div class="flex items-start space-x-5">
        <div class="flex-shrink-0">
          <div class="relative">
            <img
              v-if="user.photo"
              class="h-16 w-16 rounded-full"
              :src="`/avatars/${user.photo}`"
              alt=""
            >
            <Gravatar
              v-else
              :email="user.email"
              class="h-16 w-16 rounded-full"
              :alt="user.name"
              default="mp"
              :size="80"
              rating="g"
            />
            <span
              class="absolute inset-0 rounded-full shadow-inner"
              aria-hidden="true"
            />
          </div>
        </div>
        <!--
              Use vertical padding to simulate center alignment when both lines of text are one line,
              but preserve the same layout if the text wraps without making the image jump around.
            -->
        <div class="pt-1.5">
          <h1 class="text-2xl font-bold text-gray-900">
            {{ user.name }}
          </h1>
          <p class="text-sm font-medium text-gray-500">
            {{ user.email }}
          </p>
        </div>
      </div>
      <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
        <router-link
          v-if="route.params.id == authentication.user.id"
          to="/settings/profile"
          class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
        >
          Settings
        </router-link>
        <button
          v-else
          type="button"
          class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Add
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>

import { useForm } from "laravel-precognition-vue";
import { useRoute } from "vue-router";
import { onMounted, ref } from "vue";
import { Gravatar } from "@sauromates/vue-gravatar";
import { useAuthentication } from "@/stores/authentication.ts";
const route = useRoute();

const retrieve = useForm("get",`/api/users/${route.params.id}`, { });
const loaded = ref(false);
const user = ref({});
const authentication = useAuthentication();

onMounted(async () => {
    const response = await retrieve.submit();
    //@ts-ignore
    user.value = response.data;
    loaded.value = true;
})
</script>
