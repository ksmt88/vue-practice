import {OK} from '../util'

const state = {
    conditions: {
        category: [1, 2],
        text: '',
        currentPage: 1,
        pageTotal: 1,
        total: 1,
    },
    result: [],
    apiStatus: null,
}

const getters = {
    getConditions: state => state.conditions ? state.conditions : '',
    getConditionText: state => state.conditions.text ? state.conditions.text : '',
    getConditionCategory: state => state.conditions.category ? state.conditions.category : '',
    getResult: state => state.result ? state.result : [],
    isPrev: state => state.conditions.currentPage > 1,
    isNext: state => state.conditions.currentPage < state.conditions.pageTotal,
    getCurrentPage: state => state.conditions.currentPage,
}

const mutations = {
    setConditions(state, conditions) {
        state.conditions = conditions
    },
    setApiStatus(state, status) {
        state.apiStatus = status
    },
    setResult(state, result) {
        state.result = result
    }
}

const actions = {
    async setConditions(context, conditions) {
        context.commit('setConditions', conditions)
    },
    async search(context) {
        // 状態をnullに
        context.commit('setApiStatus', null)

        // データ取得
        const response = await axios.get('/api/movie', {params: state.conditions}).catch(err => err.response || err)

        // 結果チェック
        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setConditions', response.data.meta)
            context.commit('setResult', response.data)
            return state.result;
        }

        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.status, {root: true})
        return state.result;
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
