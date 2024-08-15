import  { createRouter, createWebHistory} from "vue-router";
import {useAuthentication} from "@/stores/authentication.ts";

const routes = [
    {
        name: "Login",
        path: "/auth/login",
        component: () => import("./pages/auth/Login.vue")
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes
});

const guest_routes = [
  "Login",
  "Register",
];
router.beforeEach((to, from, next) => {
    const authentication = useAuthentication();

    if (guest_routes.includes(to.name) && !authentication.is_authenticated){
        next();
    } else {
        if(!authentication.is_authenticated && to.name !== "Verify"){
            next({name: 'login'});
        } else {
            if(to.name === "login" && authentication.is_authenticated){
                next({name: "Dashboard"});
            } else {
                next();
            }
        }
    }
});

export default router;
