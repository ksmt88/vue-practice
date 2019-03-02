<?php
/**
 * 動画データ操作用.
 */

namespace App\Repository;

use \Illuminate\Support\Facades\DB;

class MovieRepository
{
    /**
     * 動画1件取得.
     *
     * @param int $id 動画ID
     *
     * @return array
     */
    public function getMovie($id)
    {
        return DB::selectOne("SELECT * FROM movies WHERE id = ?", [$id]);
    }

    /**
     * 動画検索.
     *
     * @param array $requestParam リクエストパラメータ
     *
     * @return array [int count, array movieList]
     */
    public function getMovies($requestParam)
    {
        // categoryは必須
        $where = " WHERE title IS NOT NULL";
        $bind  = [];

        // category
        if (!empty($requestParam['category'])) {
            foreach ($requestParam['category'] as $category) {
                $bindList[] = '?';
                $bind[]     = $category;
            }

            if (!empty($bindList)) {
                $where .= " AND category IN (" . implode(',', $bindList) . ") ";
            }
        }

        // text
        if (!empty($requestParam['text'])) {
            $where  .= " AND (title like ? OR description like ? ) ";
            $bind[] = "%" . $requestParam['text'] . "%";
            $bind[] = "%" . $requestParam['text'] . "%";
        }

        $movieCount = DB::selectOne("SELECT count(*) AS total FROM movies " . $where, $bind);

        // limit
        $from  = ($requestParam['currentPage'] - 1) * config('app.const.Paging');
        $limit = config('app.const.Paging');

        $movieList = DB::select("SELECT * FROM movies " . $where . " ORDER BY id DESC LIMIT {$from}, {$limit}", $bind);

        return [$movieCount->total, $movieList];
    }
}
