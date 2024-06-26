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
class MstCd extends BaseModel {
	protected $table = "mst_cd";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'group_id';
	//protected $primaryKey = 'code_cd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** String  */
        "group_id",
        /** String  */
        "code_cd",
        /** String  */
        "code_name",
        /** String  */
        "code_value",
        /** Integer  */
        "display_order",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}