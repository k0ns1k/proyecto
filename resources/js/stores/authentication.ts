import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useLocalStorage } from "@vueuse/core";
import { client, useForm } from "laravel-precognition-vue";
import { useNotifications } from "@/stores/notifications.ts";
import { useRouter } from "vue-router";

interface Token {
    access_token: String
    token_type: String
    expires_at: String
}

export interface  User {
    id: Number
    name: String
    email: String
    photo: String|null

}
export  const useAuthentication = defineStore("authentication", () => {
    const notifications = useNotifications();
    const router = useRouter();
    const loaded = ref(false);

    const token = ref(useLocalStorage("authentication.token", {
        access_token: "",
        token_type: "",
        expires_at: "",
    } as Token));

    const user = ref({ } as User);

    const is_authenticated = computed(() => token.value.access_token != "");

    const attempt = useForm("post","/api/attempt", {
        email:"",
        password:"",
    });

    const do_attempt = async () => {
        try {
            const response = await attempt.submit() as any;
            token.value = response.data;
            client.axios().defaults.headers.common['Authorization'] = `Bearer ${token.value.access_token}`;
            await get_profile();
            await router.replace({
                name: "Dashboard"
            });
            notifications.push({
               type: 'success',
               tittle: 'Welcome back',
               body: 'The authentication has been successfully',
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
            await router.replace({
                name: "Login"
            });
            notifications.push({
                type: 'success',
                tittle: 'Verification required',
                body: 'We recently sent you an email',
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
    const recovery = useForm("post","/api/recovery", {
        email:"",
    });

    const do_recovery = async () => {
        try {
            await recovery.submit();
            await router.replace({
                name: "Login"
            });
            notifications.push({
                type: 'success',
                tittle: 'Check your email',
                body: 'We recently sent you an email',
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

    const change_password = useForm("post","/api/change-password", {
        recovery_token:"",
        password:"",
        password_confirmation:"",
    });

    const do_change_password = async () => {
        try {
            await change_password.submit();
            await router.replace({
                name: "Login"
            });
            notifications.push({
                type: 'success',
                tittle: 'Password was changed',
                body: 'Now you can sign in',
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

    const change_profile = useForm("post","/api/profile", {
        photo: new File([], ""),
    });

    const do_change_profile = async () => {
        try {
            await change_profile.submit();
            notifications.push({
                type: 'success',
                tittle: 'Profile was updated',
                body: 'Check how it looks like',
            });
            await  get_profile();
        } catch (e: any) {
            notifications.push({
                type: 'error',
                tittle: 'Something went wrong',
                body: e.response.data.message,
            });
            console.error(e);
        }
    }


    const sign_out = async () => {
        token.value = {
            access_token: "",
            token_type: "",
            expires_at: "",
        } as Token
        await router.replace({
            name: "Login"
        });
    }

    const profile = useForm("get", "/api/user", {});
    const get_profile = async () => {
        const response = await profile.submit() as any;
        user.value = response.data;
    };

    return {
        loaded,
        token,
        user,
        is_authenticated,
        attempt,
        do_attempt,
        register,
        do_register,
        recovery,
        do_recovery,
        change_password,
        do_change_password,
        change_profile,
        do_change_profile,
        sign_out,
        get_profile,
    }
});
