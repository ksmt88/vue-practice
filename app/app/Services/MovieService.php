<?php
/**
 * 動画操作.
 */

namespace App\Services;

use App\Movie;
use App\Repository\MovieRepository;

class MovieService
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * 動画検索.
     *
     * @param int $id 動画ID
     *
     * @return string json
     */
    public function getMovie($id)
    {
        // バリデーション
        if (empty($id)) {
            return json_encode([
                "total"       => 0,
                "currentPage" => 0,
                'data'        => [],
            ], JSON_PRETTY_PRINT);
        }

        // データ取得
        $movie = $this->movieRepository->getMovie($id);

        // jsonへ変換
        return json_encode($movie, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * 動画検索.
     *
     * @param array $requestParam リクエストパラメータ
     *
     * @return string json
     */
    public function getMovies($requestParam)
    {
        // バリデーション
        if (!$this->getMoviesValidation($requestParam)) {
            return json_encode([
                "total"       => 0,
                "currentPage" => 0,
                'data'        => [],
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // データ取得
        list($movieCount, $movieList) = $this->movieRepository->getMovies($requestParam);

        // 属性追加
        $returnJson = $this->addAttributes($requestParam, $movieCount, $movieList);

        // jsonへ変換
        return json_encode($returnJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * 検索時のバリデーション.
     *
     * @param array $requestParam リクエストパラメータ
     *
     * @return bool
     */
    protected function getMoviesValidation($requestParam)
    {
        return true;
    }

    protected function addAttributes($requestParam, $movieCount, $movieList)
    {
        // 初期化
        $return = [
            "meta" => [
                "total"       => (empty($movieCount)) ? 0 : $movieCount,
                "pageTotal"   => (empty($movieCount)) ? 0 : ceil($movieCount / config('app.const.Paging')),
                "category"    => (empty($requestParam['category'])) ? 0 : $requestParam['category'],
                "text"        => (empty($requestParam['text'])) ? '' : $requestParam['text'],
                "currentPage" => (empty($requestParam['currentPage'])) ? 0 : (int)$requestParam['currentPage'],
            ],
            'data' => [],
        ];

        foreach ($movieList as $movie) {
            $return['data'][] = [
                'id'           => $movie->id,
                'title'        => $movie->title,
                'description'  => $movie->description,
                'time'         => $movie->time,
                'category'     => $movie->category,
                'categoryName' => config('app.const.Category')[$movie->category],
                'url'          => $movie->url,
                'thumbnailUrl' => $movie->thumbnail_url,
                'createdAt'    => $movie->created_at,
                'updatedAt'    => $movie->updated_at,
            ];

            if (count($return['data']) >= 9) {
                break;
            }
        }

        return $return;
    }
}
