<?php

namespace App\Services;

use DB;
use App\Models\TrnInternalNews;

/**
 * Hrm1010Service class
 */
class Hrm1010Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectById($id)
    {
        $sqlParam = array();
        $sql      = "
        select *
        from trn_internal_news
        where id = ?
        limit 1
        ";

        $sqlParam[] = $id;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * @param $param
     */
    public function saveEntity($param)
    {

        $entity = null;

        if (0 == $param["id"]) {
            $entity = new TrnInternalNews();
        } else {
            $entity = TrnInternalNews::find($param["id"]);

            if (!isset($entity)) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Không tồn tại",
                ];
            }

        }

        $user = $this->logonUser();

        $entity->title   = $param["title"];
        $entity->content = $param["content"];

        $this->updateRecordHeader($entity, $user, 0 == $param["id"]);

        $entity->save();

        return [
            "rtnCd" => true,
            "id"    => $entity->id,
            "msg"   => "Cập nhật thành công",
        ];
    }

    /**
     * @param $id
     */
    public function deleteEntity($id)
    {
        TrnInternalNews::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Xóa thành công",
        ];
    }

    /**
     * @param $param
     */
    public function publish($param)
    {

        $entity = TrnInternalNews::find($param["id"]);

        if (!isset($entity)) {
            return [
                "rtnCd" => false,
                "msg"   => "Không tìm thấy dữ liệu",
            ];
        }

        $entity->news_sts = '1';
        $entity->title    = $param["title"];
        $entity->content  = $param["content"];
        $this->updateRecordHeader($entity, null, false);
        $entity->save();

        return [
            "rtnCd" => true,
            "msg"   => "Publish thành công",
        ];
    }

}
