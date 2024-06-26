<?php

namespace App\Services;

use DB;

class NewsService extends BaseService
{
    /**
     * @param $limit
     */
    public function selectList($limit = 0)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.id
                , a.publish_date
                , a.slug
                , a.title
                , a.content
                , a.short_content
                , a.image_path
                , a.feature_image_path
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from
                mst_news a
            where
                a.active_flg = '1'
                and show_flg = '1'
            order by
                a.publish_date desc,
                a.id desc
			";

        if ($limit > 0) {
            $sql .= "
  			    limit ?
            ";
            $sqlParam[] = $limit;
        }

        //return $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function selectBySlug(
        $slug,
        $preview = false
    ) {
        $sqlParam = array();
        $sql      = "
            select
              id
              , publish_date
              , slug
              , title
              , description
              , keywords
              , short_content
              , content
              , image_path
              , feature_image_path
              , show_flg
            from
              mst_news
            where
              slug = ?
              and active_flg = '1'
        ";

        if (false == $preview) {
            $sql .= "
            and show_flg = '1'
            and publish_date < now()
          ";
        }

        $sqlParam[] = $slug;

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (empty($list)) {
            return null;
        }

        return $list[0];
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function selectByIdForPreview(
        $id,
        $preview = false
    ) {
        $sqlParam = array();
        $sql      = "
            select
              id
              , publish_date
              , slug
              , title
              , description
              , keywords
              , short_content
              , content
              , image_path
              , feature_image_path
              , show_flg
            from
              mst_news
            where
              id = ?
              and active_flg = '1'
        ";

        if (false == $preview) {
            $sql .= "
            and show_flg = '1'
            and publish_date < now()
          ";
        }

        $sqlParam[] = $id;

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (empty($list)) {
            return null;
        }

        return $list[0];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function selectNextNews($id)
    {
        $sqlParam = array();
        $sql      = "
            select
              id
              , publish_date
              , slug
              , title
              , description
              , keywords
              , short_content
              , content
              , image_path
              , feature_image_path
              , show_flg
            from
              mst_news
            where
              id > ?
              and active_flg = '1'
              and show_flg = '1'
              and publish_date < now()
            order by publish_date desc
            limit 1
			";

        $sqlParam[] = $id;

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (empty($list)) {
            return null;
        }

        return $list[0];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function selectPrevNews($id)
    {
        $sqlParam = array();
        $sql      = "
            select
              id
              , publish_date
              , slug
              , title
              , description
              , keywords
              , short_content
              , content
              , image_path
              , feature_image_path
              , show_flg
            from
              mst_news
            where
              id < ?
              and active_flg = '1'
              and show_flg = '1'
              and publish_date < now()
            order by publish_date desc
            limit 1
			";

        $sqlParam[] = $id;

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (empty($list)) {
            return null;
        }

        return $list[0];
    }

}
