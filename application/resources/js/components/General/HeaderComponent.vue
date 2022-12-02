<template>

    <v-card class="overflow-hidden">
        <v-app-bar absolute color="indigo darken-2" dark shrink-on-scroll prominent fade-img-on-scroll
            scroll-target="#scrolling-techniques-3">
            <template v-slot:img="{ props }">
                <v-img v-bind="props" gradient="to top right, rgba(19,84,122,.5), rgba(128,208,199,.8)"></v-img>
            </template>
            <v-toolbar-title>Program SPK</v-toolbar-title>
            <v-spacer></v-spacer>
            <div v-if="authStore.user != null">
                <div v-if="authStore.user.account_privileges.title == 'Super Admin Role'">
                    <div>
                        <router-link :to="{ name: 'Home' }">
                            <v-btn>
                                Home
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'Inputadmin' }">
                            <v-btn>
                                Input
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'MasterList' }">
                            <v-btn>
                                master
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'CheckFull' }">
                            <v-btn>
                                Check Full
                            </v-btn>
                        </router-link>
                        <router-link :to="{ name: 'Settings' }">
                            <v-btn>
                                Settings
                            </v-btn>
                        </router-link>

                        <span class="white--text text-h5"> Welcome,{{ authStore.user.account_name }}</span>

                        <v-btn @click.prevent="Logout">
                            Logout
                        </v-btn>
                    </div>
                </div>
                <div v-else-if="authStore.user.account_privileges.title == 'Admin Role'">
                    <router-link :to="{ name: 'Inputadmin' }">
                        <v-btn>
                            Input
                        </v-btn>
                    </router-link>
                    <router-link :to="{ name: 'MasterList' }">
                        <v-btn>
                            master
                        </v-btn>
                    </router-link>
                    <v-btn @click.prevent="Logout">
                        Logout
                    </v-btn>
                </div>
                <div v-else-if="authStore.user.account_privileges.title == 'Staff Role'">
                    <router-link :to="{ name: 'Inputadmin' }">
                        <v-btn>
                            Input
                        </v-btn>
                    </router-link>
                    <v-btn @click.prevent="Logout">
                        Logout
                    </v-btn>
                </div>
            </div>
            <div v-else>
                <router-link :to="{ name: 'Login' }">
                    <v-btn>
                        Login
                    </v-btn>
                </router-link>
            </div>

        </v-app-bar>
        <v-sheet id="scrolling-techniques-2" class="overflow-y-auto" max-height="600">
            <v-container style="height: 120px;"></v-container>
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
    }
}

</script>


<style lang="scss" scoped >
#title-nav {
    color: black;
}
</style>


