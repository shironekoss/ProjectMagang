<template>
    <header id="nav-wrapper">
        <nav id="nav">
            <div class="nav left">
                <span class="gradient skew">
                    <h1 class="logo un-skew"><a href="#home">Logo Here</a></h1>
                </span>
                <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
            </div>
            <div class="nav right">
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
                            class="u-nav">Contact</span></span></a>
            </div>
        </nav>
    </header>
</template>


<style >
</style>
