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
class MstBranch extends BaseModel {
	protected $table = "mst_branch";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'branch_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "branch_id",
        /** String  */
        "branch_code",
        /** String  */
        "branch_name",
        /** String  */
        "branch_address",
        /** String  */
        "branch_contact",
        /** LocalDate  */
        "started_date",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}