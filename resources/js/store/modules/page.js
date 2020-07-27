import { SET_PAGE } from "../mutation-types"

const state = {
    page: 'menu'
}

const actions = {
    setPage({ commit }, value) {
        commit(SET_PAGE, value)
    }
}

const mutations = {
    [SET_PAGE](state, value) {
        state.page = value
    }
}

export default {
    state, actions, mutations
}