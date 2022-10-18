<!-- <template>
    <header id="nav-wrapper">
        <nav id="nav">
            <div class="nav left">
                <span class="gradient skew">
                    <h1 class="logo un-skew">
                        <a href="#home">
                            <div id="title-nav">
                                <img src="../../../images/240px-Logo_Adi_Putro.svg.png" alt="#">
                                <label for=""> PT Adiputro Wirasejati</label>
                            </div>
                        </a>
                    </h1>
                </span>
                <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
            </div>
        </nav>
    </header>
</template> -->
<template>
    <v-card class="overflow-hidden">
        <v-app-bar absolute color="#6A76AB" dark shrink-on-scroll prominent src="https://picsum.photos/1920/1080?random"
            fade-img-on-scroll scroll-target="#scrolling-techniques-3">
            <template v-slot:img="{ props }">
                <v-img v-bind="props" gradient="to top right, rgba(19,84,122,.5), rgba(128,208,199,.8)"></v-img>
            </template>
                <v-toolbar-title>Program SPK</v-toolbar-title>
            <v-spacer></v-spacer>
            <router-link :to="{ name: 'Login' }">
                <v-btn>
                    Login
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
            <router-link :to="{ name: 'Settings' }">
                <v-btn>
                    Settings
                </v-btn>
            </router-link>

        </v-app-bar>
        <v-sheet id="scrolling-techniques-2" class="overflow-y-auto" max-height="600">
            <v-container style="height: 120px;"></v-container>
        </v-sheet>
    </v-card>
</template>


<script>
    // import { useAuthStore } from '@/stores';
// import { useAuth } from '../../../Stores/Auth';
// const Auth = useAuth();
</script>


<style lang="scss" scoped >
#title-nav {
    color: black;
}

@import'../../../sass/Component/Header.scss';
</style>
