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
class MstWarehouse extends BaseModel {
	protected $table = "mst_warehouse";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'warehouse_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "warehouse_id",
        /** String  */
        "name",
        /** String  */
        "address",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}