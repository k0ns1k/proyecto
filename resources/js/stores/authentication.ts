import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useLocalStorage } from "@vueuse/core";
import { useForm } from "laravel-precognition-vue";

interface Token {
    access_token: String
    token_type: String
    expires_at: String
}
export  const useAuthentication = defineStore("authentication", () => {
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
        } catch (e) {
            console.error(e);
        }
    }

    return {
        token,
        is_authenticated,
        attempt,
        do_attempt,
    }
});
