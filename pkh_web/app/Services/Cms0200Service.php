<?php

namespace App\Services;

use App\Models\MstNews;

/**
 * Cms0200Service class
 */
class Cms0200Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
              a.id
              , a.publish_date
              , a.slug
              , a.title
              , a.feature_image_path
              , a.show_flg
              , a.active_flg
              , a.created_at
              , a.created_by
              , a.updated_at
              , a.updated_by
              , a.version_no
              , b.name updated_by_name
            from
              mst_news a
              left join users b
                on a.updated_by = b.id
            where 1 = 1
        ";

        $sql .= $this->andWhereDateBetween($param, 'start_date', 'end_date', 'a.publish_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'title', 'a.title', $sqlParam);
        $sql .= $this->andWhereString($param, 'keyword', 'a.content', $sqlParam);

        $orderBy = $this->getOrderBy($param, [
            'id'              => [
                "asc"  => " a.id ",
                "desc" => " a.id desc ",
            ],
            'publish_date'    => [
                "asc"  => " a.publish_date  ",
                "desc" => " publish_date desc ",
            ],
            'title'           => [
                "asc"  => " a.title ",
                "desc" => " a.title desc ",
            ],
            'updated_at'      => [
                "asc"  => " a.updated_at ",
                "desc" => " a.updated_at desc ",
            ],
            'updated_by_name' => [
                "asc"  => " b.name ",
                "desc" => " b.name desc ",
            ],
        ]);

        if (!empty($orderBy)) {
            $sql .= $orderBy;
        } else {
            $sql .= "
            order by
              a.publish_date desc
              , a.updated_at desc ";
        }

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @param $param
     */
    public function updateStatus($param)
    {
        $news = MstNews::find($param["id"]);

        if (!isset($news)) {
            return [
                'rtnCd' => false,
                'msg'   => "Không tìm thấy tin tức " . $param["id"],
            ];
        }

        $news->show_flg = $param["show_flg"];

        $logonUser = $this->logonUser();
        $this->updateRecordHeader($news, $logonUser);
        $news->save();

        return [
            'rtnCd' => true,
            'msg'   => "Cập nhật thành công " . $param["id"],
        ];
    }

}
