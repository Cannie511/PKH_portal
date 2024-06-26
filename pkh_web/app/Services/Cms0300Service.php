<?php

namespace App\Services;

use DB;
use Log;
use App\Models\MstOaFollower;


class Cms0300Service extends BaseService
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
                a.oa_follower_id
                ,a.store_id
                , a.avatar
                , a.user_id
                , a.user_id_by_app
                , a.display_name
                , a.birth_date
                ,a.notes
            from 
                mst_oa_follower a
            where 1 = 1
        ";

        $sql .= $this->andWhereString($param, 'user_id', 'a.user_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'display_name', 'a.display_name', $sqlParam);
        $sql .= $this->andWhereString($param, 'notes', 'a.notes', $sqlParam);


        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    public function updateFollowers($data)
    {
        // ini_set('max_execution_time', 180);
        DB::table('mst_oa_follower')->truncate();
        foreach ($data as $item) {
            // Log::debug($item);
            if ($item["error"]== 0){
                $entity                     = new MstOaFollower();
                $entity->avatar             = $item["data"]["avatar"];
                $entity->user_id            = $item["data"]["user_id"];
    
                $entity->user_id_by_app     = $item["data"]["user_id_by_app"];
                $entity->display_name       = $item["data"]["display_name"];
                $entity->birth_date         = $item["data"]["birth_date"];
                if (count($item["data"]["tags_and_notes_info"]["notes"])>0){
                    $entity->notes              = $item["data"]["tags_and_notes_info"]["notes"][0];
                }
    
                DB::transaction(function () use ($entity) {
                    $entity->save();
                });
            }
           
        }

    }

}