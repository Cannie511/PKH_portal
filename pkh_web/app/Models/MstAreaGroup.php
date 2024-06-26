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
class MstAreaGroup extends BaseModel {
	protected $table = "mst_area_group";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'area_group_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "area_group_id",
        /** String  */
        "name",
        /** Integer  */
        "payment_day",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}