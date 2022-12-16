<template>
    <v-card class="overflow-hidden">
        <v-app-bar
            absolute
            color="#7e84d1"
            dark
            shrink-on-scroll
            prominent
            src="../../../images/gradient.png"
            fade-img-on-scroll
            scroll-target="#scrolling-techniques-3"
        >
            <template v-slot:img="{ props }">
                <v-img
                v-bind="props"
                gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
                ></v-img>
            </template>

            <div class="logo-header">
                <img src="../../../images/adiputro_logo.png" style="width:100px; height: 80px;">
            </div>

            <v-spacer></v-spacer>

            <div v-if="authStore.user != null" >
                <div v-if="authStore.user.account_privileges.title == 'Super Admin Role'">
                    <div>
                        <span class="white--text text-h5 welcome-text"> Welcome, {{ authStore.user.account_name }}</span>
                        <router-link :to="{ name: 'Home' }">
                            <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                                Home
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'Inputadmin' }">
                            <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                                Input
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'MasterList' }">
                            <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                                master
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'CheckFull' }">
                            <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                                Check Full
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'Settings' }">
                            <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                                Settings
                            </v-btn>
                        </router-link>

                        <v-btn class="ma-2 header-button"
                                outlined
                                color="indigo" @click.prevent="Logout">
                            LOGOUT
                        </v-btn>

                    </div>

                </div>
                <div v-else-if="authStore.user.account_privileges.title == 'Admin Role'">
                    <router-link :to="{ name: 'Inputadmin' }">
                        <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                            Input
                        </v-btn>
                    </router-link>
                    <router-link :to="{ name: 'MasterList' }">
                        <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                            master
                        </v-btn>
                    <span class="white--text text-h5"> Welcome,{{ authStore.user.account_name }}</span>
                    </router-link>
                    <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo" @click.prevent="Logout">
                        Logout
                    </v-btn>
                </div>
                <div v-else-if="authStore.user.account_privileges.title == 'Staff Role'">
                    <router-link :to="{ name: 'Inputadmin' }">
                        <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                            Input
                        </v-btn>
                    </router-link>
                    <span class="white--text text-h5"> Welcome,{{ authStore.user.account_name }}</span>
                    <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo" @click.prevent="Logout">
                        Logout
                    </v-btn>
                </div>
            </div>
            <div v-else>
                <router-link :to="{ name: 'Login' }">
                    <v-btn class="ma-2 header-button"
                            outlined
                            color="indigo">
                        Login
                    </v-btn>
                </router-link>
            </div>

        </v-app-bar>
        <v-sheet
            id="scrolling-techniques-3"
            class="overflow-y-auto"
            max-height="600"
            >
            <v-container style="height: 127px;"></v-container>
        </v-sheet>
    </v-card>
</template>

<script>
import { useAuth } from '../../../Stores/Auth';
import Swal from 'sweetalert2'
export default {
    setup() {
        const authStore = useAuth();
        return { authStore }
    },
    data(){
        return {
            items: [
                { title: 'LOGOUT' },
            ],
        }
    }
    ,
    methods: {
        async Logout() {
            await this.authStore.handleLogout();
            if (this.authStore.user == null) {
                this.$router.push({ name: 'Home' })
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ada masalah dengan tombol Logout',
                })
            }
        },
    },
}

</script>


<style lang="scss" scoped >
#title-nav {
    color: black;
}
</style>


