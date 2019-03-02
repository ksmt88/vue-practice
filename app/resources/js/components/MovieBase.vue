<template>
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-xl-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky search">
                    <form method="POST" class="">
                        <div class="input-group mb-3">
                            <input type="text" placeholder="特徴など"
                                   class="form-control" id="search"
                                   v-model="conditions.text"
                                   v-on:keyup.enter="search">
                            <label for="search" class="d-none">検索</label>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" v-on:click="search" type="button">検索</button>
                            </div>
                            <!--<div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="category1" value="1" checked="checked">
                                <label class="form-check-label" for="category1">Youtube</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="category2" value="2" checked="checked">
                                <label class="form-check-label" for="category2">Youtube</label>
                            </div>-->
                        </div>
                    </form>
                </div>
                <div class="sidebar-sticky d-none d-md-block">
                    <!--<ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="shopping-cart"></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="users"></span>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="layers"></span>
                                Integrations
                            </a>
                        </li>
                    </ul>-->
                    <div class="banner">

                    </div>
                </div>
            </nav>
            <main role="main" class="col-xl-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <div v-if="apiStatus === false" class="alert alert-danger w-100">不正なリクエストです</div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">banner</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <RouterView/>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">banner</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example" v-if="this.$route.path === '/'">
                    <ul class="pagination justify-content-center">
                        <li :class="[this.$store.getters['search/getCurrentPage'] === 1 ? 'page-item disabled' : 'page-item']">
                            <button class="page-link" v-on:click="first" type="button">最初へ</button>
                        </li>
                        <li v-for="index in this.viewPage" :key="index"
                            :class="[$parent.$store.getters['search/getCurrentPage'] === index ? 'page-item disabled' : 'page-item']">
                            <button class="page-link" v-on:click="page" type="button" :value="index">{{index}}</button>
                        </li>
                        <li :class="[this.$store.getters['search/getCurrentPage'] === this.conditions.pageTotal ? 'page-item disabled' : 'page-item']">
                            <button class="page-link" v-on:click="last" type="button">最後へ</button>
                        </li>
                    </ul>
                </nav>
            </main>
        </div>
        <div id="returnTop">
            <a href="#">
                TOP
            </a>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'

    //let config = require('../../config');

    const pagingNum = 9;

    export default {
        name: "MovieBase",
        mounted() {
        },
        data() {
            return {
                conditions: {
                    text: '',
                },
                viewPage: [1]
            }
        },
        computed: {
            apiStatus() {
                return this.$store.state.search.apiStatus
            },
        },
        methods: {
            async search() {
                this.result = await this.$store.dispatch('search/search');
                this.conditions = this.$store.getters['search/getConditions']
                await this.paging()
            },
            async first() {
                this.conditions.currentPage = 1;
                await this.$store.dispatch('search/setConditions', this.conditions)
                this.result = await this.$store.dispatch('search/search');
                await this.paging()
            },
            async last() {
                this.conditions.currentPage = this.conditions.pageTotal;
                await this.$store.dispatch('search/setConditions', this.conditions)
                this.result = await this.$store.dispatch('search/search');
                await this.paging()
            },
            async page(e) {
                this.conditions.currentPage = parseInt(e.target.value);
                await this.$store.dispatch('search/setConditions', this.conditions)
                this.result = await this.$store.dispatch('search/search');
                await this.paging()
            },
            async paging() {
                if (this.conditions.pageTotal > 9) {
                    if (this.conditions.currentPage < 6) {
                        this.viewPage = [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    } else if (this.conditions.currentPage > this.conditions.pageTotal - 5) {
                        this.viewPage = Array.from(new Array(9)).map((v, i) => i + this.conditions.pageTotal - 8);
                    } else {
                        this.viewPage = Array.from(new Array(9)).map((v, i) => i + this.conditions.currentPage - 4);
                    }
                } else {
                    this.viewPage = Array.from(new Array(this.conditions.pageTotal)).map((v, i) => i + 1)
                }
            }
        },
        watch: {
            $route: {
                async handler() {
                    this.conditions = this.$store.getters['search/getConditions']
                    await this.search()
                },
                immediate: true
            }
        }
    }
</script>
