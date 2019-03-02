<template>
    <div class="row">
        <div class="col-md-4 mb-3" v-for="movie in $store.state.search.result.data"
             v-bind:key="movie.id">
            <div class="card">
                <h5 class="card-header">{{ movie.title }}</h5>
                <span class="d-none">{{ movie.description }}</span>
                <div class="card-body">
                    <div class="movie-image">
                        <router-link :to="{ path: 'movie/' + movie.id, params: { id: movie.id }}">
                            <img class="w-100" v-bind:src="movie.thumbnailUrl" :alt="movie.title">
                            <span class="movie-tag">{{ movie.categoryName }}</span>
                            <span class="movie-time">{{ movie.time }}</span>
                        </router-link>
                    </div>
                    <p class="card-text">{{ movie.description | characterCut }}</p>
                    <router-link class="btn btn-danger btn-block"
                                 :to="{ path: 'movie/' + movie.id, params: { id: movie.id }}">
                        閲覧する
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "MovieList",
        filters: {
            characterCut: function (value) {
                if (!value) return ''
                value = value.toString()
                return (value.length > 50) ? value.substr(0, 50) + "..." : value
            }
        },
    }
</script>

<style>
    .movie-image {
        position: relative;
    }

    .movie-tag {
        position: absolute;
        top: 0;
        left: 0;
        color: #fff;
        background-color: #000;
        opacity: 0.7;
        padding: 1px 4px;
    }

    .movie-time {
        position: absolute;
        bottom: 0;
        right: 0;
        color: #fff;
        background-color: #000;
        opacity: 0.7;
        padding: 1px 4px;
    }
</style>
