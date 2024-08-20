import { createRouter, createWebHistory } from "vue-router";
import { useAuthentication } from "@/stores/authentication.ts";

const routes = [
    {
        name: "Login",
        path: "/auth/login",
        component: () => import("./pages/auth/Login.vue"),
    },
    {
        name: "Register",
        path: "/auth/register",
        component: () => import("./pages/auth/Register.vue"),
    },
    {
        name: "Recovery",
        path: "/auth/recovery",
        component: () => import("./pages/auth/Recovery.vue"),
    },
    {
        name: "ChangePassword",
        path: "/auth/change-password/:token",
        component: () => import("./pages/auth/ChangePassword.vue"),
    },
    {
        name: "Verify",
        path: "/auth/verify/:token",
        component: () => import("./pages/auth/Verify.vue"),
    },
    {
        name: "Dashboard",
        path: "/auth/dashboard",
        component: () => import("./pages/auth/Dashboard.vue"),
    },
    {
        name: "ChangeProfile",
        path: "/settings/profile",
        component: () => import("./pages/settings/Profile.vue"),
    },
    {
        name: "Profile",
        path: "/profile/:id",
        component: () => import("./pages/Profile.vue"),
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

const guest_routes = ["Login", "Register", "Recovery", "ChangePassword"];

//@ts-ignore
router.beforeEach((to, from, next) => {
    const authentication = useAuthentication();

    if (
        guest_routes.includes(to.name as string) &&
        !authentication.is_authenticated
    ) {
        next();
    } else {
        if (!authentication.is_authenticated && to.name !== "Verify") {
            next({ name: "Login" });
        } else {
            if (
                guest_routes.includes(to.name as string) &&
                authentication.is_authenticated
            ) {
                next({ name: "Dashboard" });
            } else {
                next();
            }
        }
    }
});

export default router;
