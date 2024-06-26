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
class TrnWebOrderDetail extends BaseModel {
	protected $table = "trn_web_order_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'web_order_id';
	//protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "web_order_id",
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