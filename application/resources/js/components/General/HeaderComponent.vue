<template>
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
            <div class="nav right">
                <div>

                </div>
                <a href="#home" class="nav-link"><span class="nav-link-span"><span class="u-nav">
                            <router-link :to="{ name: 'Home' }">Home</router-link>
                        </span></span></a>
                <a href="#about" class="nav-link"><span class="nav-link-span"><span class="u-nav">
                            <router-link :to="{ name: 'Login' }">Login</router-link>
                        </span></span></a>
                <a href="#work" class="nav-link"><span class="nav-link-span"><span class="u-nav">
                            <router-link :to="{ name: 'User' }">User</router-link>
                        </span></span></a>
                <a href="#contact" class="nav-link"><span class="nav-link-span"><span
                            class="u-nav">
                            <router-link :to="{ name: 'InputNoSPK' }">SPK</router-link>
                            </span></span></a>
            </div>
        </nav>
    </header>
</template>


<script>
// import { useAuth } from '../../../Stores/Auth';
// const Auth = useAuth();
</script>


<style lang="scss" scoped >
#title-nav{
    color: black;
}
@import'../../../sass/Component/Header.scss';
</style>
