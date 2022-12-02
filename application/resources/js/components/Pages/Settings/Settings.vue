<script>
import User from './User.vue';
import Departemen from './Departemen.vue';
import Stall from './Stall.vue';

export default {
    data() {
        return {
            toggleAccount: "Account",
        };
    },
    methods: {
        changetoggle(message) {
            this.toggleAccount = message;
        }
    },
    components: { User, Departemen, Stall }
}
</script>
<template>
    <div>
        <v-container fill-height fluid>
            <v-row justify="center">
                <v-btn-toggle >
                    <v-btn @click="changetoggle('Account')" :class="[toggleAccount == 'Account' ? 'aa' : 'white']">
                        <v-icon>Account</v-icon>
                    </v-btn>
                    <v-btn @click="changetoggle('Departemen')"
                        :class="[toggleAccount == 'Departemen' ? 'aa' : 'white']">
                        <v-icon>Departemen</v-icon>
                    </v-btn>
                    <v-btn @click="changetoggle('Stall')" :class="[toggleAccount == 'Departemen' ? 'aa' : 'white']">
                        <v-icon>Stall</v-icon>
                    </v-btn>
                </v-btn-toggle>
                <div v-if="toggleAccount === 'Account'">
                    <User />
                </div>
                <div v-if="toggleAccount === 'Departemen'">
                    <Departemen />
                </div>
                <div v-if="toggleAccount === 'Stall'">
                    <Stall />
                </div>
            </v-row>
        </v-container>
    </div>
</template>
<style>
.aa {
    background: rgba(17, 156, 199, 0.8) !important;
}

.white {
    background: rgba(255, 255, 255, 255) !important;
}
</style>

