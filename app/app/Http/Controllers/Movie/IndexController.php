<?php

namespace App\Http\Controllers\Movie;

use App\Services\MovieService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
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
     * url: GET /api/movie
     *
     * @return string json
     */
    public function index()
    {
        // リクエストパラメータ取得
        $params = $this->request->all();

        // jsonデータ取得
        return $this->movieService->getMovies($params);
    }

    /**
     * create new movie.
     * url: POST /api/movie
     *
     * @param Request $request
     *
     * @return string json
     */
    public function store(Request $request)
    {
        return '';
    }

    /**
     * show movie.
     * url: GET /api/movie/{id}
     *
     * @param $id
     *
     * @return string
     */
    public function show($id)
    {
        return $this->movieService->getMovie($id);
    }

    /**
     * update movie.
     * url: PUT /api/movie
     *
     * @param Request $request
     *
     * @return string json
     */
    public function update(Request $request)
    {
        return '';
    }

    /**
     * delete movie.
     * url: DELETE /api/movie
     *
     * @return string json
     */
    public function destroy()
    {
        return '';
    }
}
