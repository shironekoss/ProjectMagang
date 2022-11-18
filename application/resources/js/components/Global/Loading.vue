<template>
    <div>
        <v-card>
            <v-toolbar color="primary" dark class="text-lg-h5">Loading... harap menunggu</v-toolbar>
            <v-card-text></v-card-text>
            <div class="text-center">
                <v-progress-circular :size="100" :width="7" color="purple" indeterminate>
                </v-progress-circular>
            </div>
            <v-card-text></v-card-text>
        </v-card>
    </div>
</template>
