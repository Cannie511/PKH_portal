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
class TrnStoreOrder extends BaseModel {
	protected $table = "trn_store_order";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'store_order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_order_id",
        "store_id",
        "order_date",
        "total",
        /** BigDecimal  */
        "total_with_discount",
        "discount",
        /** String  */
        "notes",
       
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}