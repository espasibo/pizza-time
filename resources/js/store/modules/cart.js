import { ADD_TO_CART, REMOVE_FROM_CART, EMPTY_CART } from "../mutation-types";

const state = {
    cart: {}
}

const actions = {
    addToCart({ commit }, value) {
        commit(ADD_TO_CART, value)
    },
    removeFromCart({ commit }, value) {
        commit(REMOVE_FROM_CART, value)
    },
    emptyCart({ commit }) {
        commit(EMPTY_CART)
    }
}

const mutations = {
    [ADD_TO_CART](state, value) {
        let cart = JSON.parse(JSON.stringify(state.cart))
        let prod = cart[value.id]
        if (prod) {
            prod.quantity++
        } else {
            cart[value.id] = {
                id: value.id,
                name: value.name,
                prices: value.prices,
                quantity: 1
            }
        }
        state.cart = cart
    },
    [REMOVE_FROM_CART](state, value) {
        let cart = JSON.parse(JSON.stringify(state.cart))
        let prod = cart[value.id]
        if (prod) {
            prod.quantity--
            if (prod.quantity === 0) {
                delete cart[value.id]
            }
        }
        state.cart = cart
    },
    [EMPTY_CART](state) {
        state.cart = {}
    }
}

export default {
    state, actions, mutations
}