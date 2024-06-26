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
class MstArea extends BaseModel {
	protected $table = "mst_area";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'area_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "area_id",
        /** String  */
        "name",
        /** Integer  */
        "parent_area_id",
        /** Integer  */
        "area_group_id",
        /** Integer  */
        "salesman_id",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}