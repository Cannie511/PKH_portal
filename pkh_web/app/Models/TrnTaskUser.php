<?php
/**
 * Copyright(c) Phan Khang Home Co. VN, Ltd. All Rights Reserved.
 */

namespace App\Models;

/**
 * 
 * @author Nguyen Phu Cuong
 *
 */
class TrnTaskUser extends BaseModel {
	protected $table = "trn_task_user";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'task_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "task_id",
        /** Integer  */
        "task_group_id",
        /** Integer  */
        "user_id",
        /** String  */
        "task_name",
        /** String  */
        "task_content",
        /** Integer  */
        "task_sts",
        /** Integer  */
        "task_score",
        /** LocalDateTime  */
        "start_date",
        /** LocalDateTime  */
        "deadline",
        /** LocalDateTime  */
        "end_date",
        /** String  */
        "submit_notes",
        /** String  */
        "response_notes",
        /** String  */
        "task_code",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}