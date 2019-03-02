<template>
    <div>
        <div class="mb-3 bg-white border-bottom shadow-sm">
            <div class="container d-flex flex-column flex-md-row align-items-center p-3 px-md-4 ">
                <h1 class="my-0 mr-md-auto font-weight-normal h3"><a class="text-black-50 text-decoration-none"
                                                                     href="/">動画閲覧サンプル</a>
                </h1>
                <nav class="my-2 my-md-0 mr-md-3 row">
                    <RouterLink class="flex-sm-fill text-sm-center nav-link active" to="/">
                        動画
                    </RouterLink>
                    <!--<RouterLink class="flex-sm-fill text-sm-center nav-link active" to="/">
                        動画
                    </RouterLink>-->
                </nav>
                <!--<a class="btn btn-outline-primary" href="#">Sign up</a>-->
            </div>
        </div>
        <RouterView/>
        <!--<footer class="mb-3 bg-white border-bottom shadow-sm">
            <div class="container p-3 px-md-4 text-center">
                動画閲覧サンプル
            </div>
        </footer>-->
    </div>
</template>

<script>
    import { INTERNAL_SERVER_ERROR } from './util'

    export default {
        components: {
        },
        computed: {
            errorCode () {
                return this.$store.state.error.code
            }
        },
        watch: {
            errorCode: {
                handler (val) {
                    if (val === INTERNAL_SERVER_ERROR) {
                        this.$router.push('/500')
                    }
                },
                immediate: true
            },
            $route () {
                this.$store.commit('error/setCode', null)
            }
        }
    }
</script>

<style>
    #returnTop {
        position: fixed;
        bottom: 90px;
        right: 40px;
    }

    #returnTop a {
        text-align: center;
        display: block;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        line-height: 90px;
        color: white;
        background-color: black;
        opacity: 0.7;
    }
</style>
