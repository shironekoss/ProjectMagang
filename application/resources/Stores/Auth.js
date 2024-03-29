import { defineStore } from "pinia";
import axios from "axios";
export const useAuth = defineStore("auth", {
    state: () => ({
        authuser: null,
        authErrors: []
    }),
    getters: {
        user: (state) => state.authuser,
        errors: (state) => state.authErrors
    },
    actions: {
        async getUser() {
            this.authuser = this.authuser
        },
        async handleLogin(data) {
            this.authErrors = [];
            try {
                await axios.post('/api/login', data).then((response) => {
                    if (response.data[0] == null) {
                        this.authuser = null
                    }
                    else {
                        this.authuser = response.data[0].user
                    }
                });
            } catch (error) {}
        },
        async handleLogout() {
            try {
            this.authuser = null;
            } catch (error) {

            }
        },
    },
    persist: true
})
