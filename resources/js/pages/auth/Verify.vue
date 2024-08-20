<template>
    <div />
</template>

<script lang="ts" setup>
import { onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useForm } from "laravel-precognition-vue";
import { useNotifications } from "@/stores/notifications.ts";

const route = useRoute();
const router = useRouter();

const notifications = useNotifications();

const verification = useForm("post", "/api/verify", {
    verification_token: "",
});

onMounted(async () => {
    //@ts-ignore
    verification.verification_token = route.params.token;
    await router.replace({
        name: "Login",
    });
    try {
        await verification.submit();
        notifications.push({
            type: "success",
            tittle: "Verification success",
            body: "Your email has been verified",
        });
    } catch (e) {
        notifications.push({
            type: "error",
            tittle: "Something went wrong",
            //@ts-ignore
            body: e.response.data.message,
        });
    }
});
</script>
