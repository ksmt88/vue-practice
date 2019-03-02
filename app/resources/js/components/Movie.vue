<template>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <h5 class="card-header">{{ movie.title }}</h5>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                                v-bind:src="movie.url" allowfullscreen></iframe>
                    </div>
                    <p class="card-text">{{ movie.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {OK} from '../util'

    export default {
        name: "Movie",
        data() {
            return {
                movie: {
                    id: null,
                    title: '',
                    url: '',
                    thumbnailUrl: '',
                }
            }
        },
        methods: {
            async fetchMovie() {
                const response = await axios.get('/api/movie/' + this.$route.params.id)

                if (response.status !== OK) {
                    this.$store.commit('error/setCode', response.status)
                    return false
                }

                this.movie = response.data
            }
        },
        watch: {
            $route: {
                async handler() {
                    await this.fetchMovie()
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>