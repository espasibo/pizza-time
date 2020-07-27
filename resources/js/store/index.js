import Vue from 'vue'
import Vuex from 'vuex'
import currency from './modules/currency'
import page from './modules/page'
import cart from './modules/cart'

Vue.use(Vuex)

export default new Vuex.Store({
    strict: false,
    modules: {
        currency,
        page,
        cart
    }
})