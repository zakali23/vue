import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import theme from './theme'

Vue.use(Vuetify)

const opts = {
    iconfont: 'mdi',
    theme
}

export default new Vuetify(opts)