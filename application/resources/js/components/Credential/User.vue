<template>
    <div>
        <section v-if="$route.params.name">
            <h1> Hello {{ $route.params.name }}</h1>
        </section>
        <section v-else>
            <h1>Anda belum login</h1>
        </section>
    </div>
</template>
