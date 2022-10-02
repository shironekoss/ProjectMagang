import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import colors from 'vuetify/lib/util/colors'
Vue.use(Vuetify)

// const opts = {
//     theme: {
//         themes: {
//             light: {
//                 primary: '#3f51b5',
//                 secondary: '#b0bec5',
//                 accent: '#8c9eff',
//                 error: '#b71c1c',
//             },
//         },
//     },
// }

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: colors.purple,
                secondary: colors.grey.darken1,
                accent: colors.shades.black,
                error: colors.red.accent3,
            },
            dark: {
                primary: colors.blue.lighten3,
            },
        },
    },
})
