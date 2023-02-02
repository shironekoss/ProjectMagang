import { defineStore } from "pinia";
import { useAuth } from "./Auth";

import axios from "axios";
const authStore = useAuth();
export const useTimer = defineStore("timer", {
    state: () => ({
        timercountdown: null,
        timerset: 3600000,// this is for 1 hour
    }),
    getters: {
        gettimercountdown: (state) => state.timercountdown,
        gettimerset: (state) => state.timerset,
    },
    actions: {
        // Start timers.
        async StartTimers() {
            this.timercountdown = setTimeout(() => {
                //function here
                authStore.handleLogout();
                location.reload();
                console.log("logout")
            }, this.timerset);
        },
        //when do action
        async ResetTimers() {
            clearTimeout(this.timercountdown);
            this.StartTimers();
        },
        //logout because of timers
        async LogoutTimers() {
            authStore.handleLogout();
            location.reload();
        }
    },
    persist: true
})
