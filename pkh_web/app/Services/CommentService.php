<?php 

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;

use App\Models\TrnComment;

/**
 * CommentService class
 */
class CommentService extends BaseService {

    const STORE_VERIFY = "mst_store_verify";

	/**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
	public function selectList($param) {
        $sqlParam = array();
        $sql = "
        SELECT
          a.id
          , a.user_id
          , a.`group`
          , a.content
          , a.updated_at
          , b.name
        FROM
          trn_comment a
        LEFT JOIN users b ON
          a.user_id = b.id
        WHERE 1=1 
        ";
        
        $sql .= $this->andWhereString($param, 'group', 'a.`group`', $sqlParam );
        $sql .= $this->andWhereInt($param, 'id1', 'a.id1', $sqlParam );

        $sql .= " 
            order by
            a.created_at desc
        ";

        $result = [];
        if( isset($param['export']) && $param['export'] == true ) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
	}

    /**
     * Create new comment
     *
     * @param [type] $params
     * @param [type] $user
     * @return void
     */
    public function addComment($params, $user = null) {
        if ($user == null) {
            $user = $this->logonUser();
        }

        $entity = new TrnComment();
        foreach( $params as $key => $value) {
            $entity->$key = $value;
        }
        if (isset($user)) {
            $this->updateRecordHeader($entity, $user, true);
        }
        
        $entity->save();
        return $entity;
    }

}