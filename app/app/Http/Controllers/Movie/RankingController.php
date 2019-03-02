<?php

namespace App\Http\Controllers\Movie;

use App\Services\MovieService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    /**
     * @var Request
     */
    var $request;

    /**
     * @var MovieService
     */
    private $movieService;

    public function __construct(Request $request, MovieService $movieService)
    {
        $this->request      = $request;
        $this->movieService = $movieService;
    }

    /**
     * show movie list.
     * url: GET /api/ranking/view
     *
     * @param int $term
     *
     * @return string json
     */
    public function viewList($term = 1)
    {
        return $this->movieService->getMovies($term);
    }

    /**
     * show movie list.
     * url: GET /api/ranking/like
     *
     * @param int $term
     *
     * @return string json
     */
    public function likeList($term = 1)
    {
        return $this->movieService->getMovies($term);
    }
}
