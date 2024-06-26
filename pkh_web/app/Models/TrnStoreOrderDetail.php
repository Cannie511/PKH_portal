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
class TrnStoreOrderDetail extends BaseModel {
	protected $table = "trn_store_order_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	
	//protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_order_id",
        "store_order_detail_id",
        /** Long  */
        "product_id",
        /** Integer  */
        "pakaging",
        /** Integer  */
        "amount",
        /** BigDecimal  */
        "unit_price",
        "pakaging_type",
        "describes",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}