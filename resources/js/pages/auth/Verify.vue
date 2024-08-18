<template>

</template>

<script lang="ts" setup>

import { onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useForm } from "laravel-precognition-vue";
import { useNotifications } from "@/stores/notifications.ts";

const route = useRoute();
const router = useRouter();

const notifications = useNotifications();

const verification = useForm("post","/api/verify", {
    verification_token:"",
});

onMounted(async () => {
    verification.verification_token =route.params.token as string;
    await router.replace({
        name: "Login"
    });
    try {
        await verification.submit();
        notifications.push({
            type: 'success',
            tittle: 'Verification success',
            body: 'Your email has been verified',
        });
    } catch (e : any) {
        notifications.push({
            type: 'error',
            tittle: 'Something went wrong',
            body: e.response.data.message,
        });
    }
});
</script>

