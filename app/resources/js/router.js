/**
 * /api/movies GET 一覧取得
 * /api/movies POST 検索結果取得
 * /api/movie/{id} GET 動画取得
 * /api/movie/{id}/like GET いいね取得
 * /api/movie/{id}/like PUT いいね追加
 * /api/movie/{id}/like DELETE いいね削除
 * /api/movie POST 動画登録
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import MovieBase from './components/MovieBase.vue'
import MovieList from './components/MovieList.vue'
import Movie from './components/Movie.vue'
import SystemError from './components/System.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
    {
        path: '/',
        component: MovieBase,
        children: [
            {
                path: '/',
                component: MovieList
            },
            {
                path: '/movie/:id',
                component: Movie
            },
        ],
    },
    {
        path: '/500',
        component: SystemError
    },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
