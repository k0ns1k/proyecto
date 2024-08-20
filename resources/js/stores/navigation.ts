import { defineStore } from "pinia";
import { ref } from "vue";
import {
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
} from "@heroicons/vue/24/outline";

export const useNavigation = defineStore("navigation", () => {
    const links = ref([
        {
            name: "Dashboard",
            href: "/auth/dashboard",
            icon: HomeIcon,
            current: true,
        },
        {
            name: "Register",
            href: "/auth/register",
            icon: UsersIcon,
            current: false,
        },
        {
            name: "Revoke",
            href: "/auth/revoke",
            icon: FolderIcon,
            current: false,
        },
        {
            name: "Verify",
            href: "/auth/verify/abc",
            icon: CalendarIcon,
            current: false,
        },
        {
            name: "Login",
            href: "/auth/login",
            icon: DocumentDuplicateIcon,
            current: false,
        },
        { name: "Reports", href: "#", icon: ChartPieIcon, current: false },
    ]);

    const opened = ref(false);

    const close = () => (opened.value = false);
    const open = () => (opened.value = true);

    return {
        links,
        opened,
        open,
        close,
    };
});
