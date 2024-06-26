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
class MstWarehouseBlock extends BaseModel {
	protected $table = "mst_warehouse_block";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'warehouse_block_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "warehouse_block_id",
        /** Integer  */
        "warehouse_id",
        /** Integer  */
        "parent_block_id",
        /** String  */
        "name",
        /** String  */
        "description",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}