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
class MstWarehouseLot extends BaseModel {
	protected $table = "mst_warehouse_lot";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'warehouse_lot_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "warehouse_lot_id",
        /** String  */
        "name",
        /** Integer  */
        "length",
        /** Integer  */
        "width",
        /** Integer  */
        "height",
        /** Integer  */
        "max_item",
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