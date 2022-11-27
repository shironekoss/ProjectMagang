import Vue from 'vue';
import { createPinia, PiniaVuePlugin, setActivePinia } from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
Vue.use(PiniaVuePlugin);
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
setActivePinia(pinia);


export default pinia;
