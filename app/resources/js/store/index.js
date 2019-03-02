import Vue from 'vue'
import Vuex from 'vuex'

import search from './search'
import error from './error'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        search,
        error,
    }
})

export default store
