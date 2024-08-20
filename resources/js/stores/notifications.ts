import  { defineStore } from "pinia";
import { ref } from "vue";
import { v4 as uuid } from "uuid";

interface Notification {
    tittle: string
    body: string
    type: string
}

interface StoredNotification extends Notification {
    id: string
    visible: boolean
    create_at: Date
}
export const useNotifications = defineStore("notifications", () => {
    const events = ref<StoredNotification[]>([]);

    const push = (notification: Notification) => {
        const id = uuid();
        events.value.push({
            id: id,
            visible: true,
            create_at: new Date(),
            ...notification
        });
        setTimeout(() => {
            const index = events.value
                .findIndex((item) => item.id === id)
            events.value[index].visible = false;
        },5000);
    }
    return {
        events,
        push,
    }
});
