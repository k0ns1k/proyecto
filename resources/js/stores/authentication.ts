import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useLocalStorage } from "@vueuse/core";
import { useForm } from "laravel-precognition-vue";
import { useNotifications } from "@/stores/notifications.ts";
import { useRouter } from "vue-router";

interface Token {
    access_token: String
    token_type: String
    expires_at: String
}
export  const useAuthentication = defineStore("authentication", () => {
    const notifications = useNotifications();
    const router = useRouter();

    const token = ref(useLocalStorage("authentication.token", {
        access_token: "",
        token_type: "",
        expires_at: "",
    } as Token));

    const is_authenticated = computed(() => token.value.access_token != "");

    const attempt = useForm("post","/api/attempt", {
        email:"",
        password:"",
    });

    const do_attempt = async () => {
        try {
            const response = await attempt.submit() as any;
            token.value = response.data;
            notifications.push({
               type: 'success',
               tittle: 'Welcome back',
               body: 'The authentication has been successfully',
            });
            await router.replace({
                name: "Dashboard"
            });
        } catch (e: any) {
            notifications.push({
                type: 'error',
                tittle: 'Something went wrong',
                body: e.response.data.message,
            });
            console.error(e);
        }
    }


    const register = useForm("post","/api/register", {
        name:"",
        email:"",
        password:"",
        password_confirmation:"",
    });

    const do_register = async () => {
        try {
            await register.submit();
            notifications.push({
                type: 'success',
                tittle: 'Verification required',
                body: 'We recently sent you an email',
            });
            await router.replace({
                name: "Login"
            });
        } catch (e: any) {
            notifications.push({
                type: 'error',
                tittle: 'Something went wrong',
                body: e.response.data.message,
            });
            console.error(e);
        }
    }

    return {
        token,
        is_authenticated,
        attempt,
        do_attempt,
        register,
        do_register,
    }
});
