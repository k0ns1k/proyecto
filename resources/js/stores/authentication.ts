import { defineStore } from "pinia";
import { ref } from "vue";

interface Token {
    access_token: String
    token_type: String
    expires_at: String
}
export  const useAuthentication = defineStore("authentication", () => {
    const token = ref({} as Token);

    return {
        token,
    }
});
