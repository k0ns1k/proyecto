import './bootstrap';
import '../css/app.css';

import router from "@/router.ts";
import { createApp } from "vue";
import { createPinia } from "pinia";

import App  from '@/components/App.vue';

const pinia = createPinia();

createApp(App)
    .use(router)
    .use(pinia)
    .mount("#app");
