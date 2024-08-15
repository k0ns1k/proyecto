import { defineStore } from "pinia";
import { ref } from "vue";
import {
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon
} from "@heroicons/vue/24/outline";


export  const useNavigation = defineStore("navigation", () => {

    const links = ref([
        { name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
        { name: 'Team', href: '#', icon: UsersIcon, current: false },
        { name: 'Projects', href: '#', icon: FolderIcon, current: false },
        { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
        { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
        { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
    ]);

    const opened = ref(false);

    const close =() => opened.value = false;
    const open =() => opened.value = true;

    return {
        links,
        opened,
        open,
        close,
    }
});
