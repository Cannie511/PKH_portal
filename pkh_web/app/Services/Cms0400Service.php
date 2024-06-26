<?php

namespace App\Services;

use DB;
use Log;
use App\Models\TrnEsmsRecord;

class Cms0400Service extends BaseService
{
    public function selectListEsms($param){
        $sqlParam = array();
        $sql      = "
            select 
                a.id
                ,a.param
                ,a.ref_id
                ,a.type
                ,a.notes
                ,a.phone
                ,a.temp_id
                ,a.code_result
                ,a.SMSID
                ,a.active_flg
                ,a.created_at
                ,a.created_by
                ,a.updated_at
                ,a.updated_by
            from 
               trn_esms_record a
            where 1 = 1 
        ";

        $sql .= $this->andWhereString($param, 'phone', 'a.phone', $sqlParam);
        // $sql .= $this->andWhereString($param, 'display_name', 'a.display_name', $sqlParam);
        // $sql .= $this->andWhereString($param, 'notes', 'a.notes', $sqlParam);

        $sql .= "
        order by 
        a.created_at desc
        ";
        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

 

}