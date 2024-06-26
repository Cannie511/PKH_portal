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
class MstTaskGroup extends BaseModel {
	protected $table = "mst_task_group";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'task_group_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "task_group_id",
        /** String  */
        "task_group_name",
        /** Integer  */
        "task_group_weight",
        /** String  */
        "task_group_notes",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}