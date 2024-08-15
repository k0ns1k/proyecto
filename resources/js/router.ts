import  { createRouter, createWebHistory} from "vue-router";

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

// router.beforeEach((to, from, next) => {
//     next();
// });

export default router;
