import { SET_CUR } from "../mutation-types"

const state = {
    cur: {}
}

const actions = {
    setCur({ commit }, value) {
        commit(SET_CUR, value)
    }
}

const mutations = {
    [SET_CUR](state, value) {
        state.cur = value
    }
}

export default {
    state, actions, mutations
}