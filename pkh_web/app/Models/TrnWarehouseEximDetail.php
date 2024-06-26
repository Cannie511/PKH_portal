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
class TrnWarehouseEximDetail extends BaseModel {
	protected $table = "trn_warehouse_exim_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'warehouse_exim_id';
	//protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "warehouse_exim_id",
        /** Long  */
        "product_id",
        /** Integer  */
        "seq_no",
        /** Integer  */
        "amount",
        /** BigDecimal  */
        "unit_price",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}