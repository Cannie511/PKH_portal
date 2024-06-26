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
class TrnStoreRank extends BaseModel {
	protected $table = "trn_store_rank";

	/**
     * The primary key for the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_id",
        /** Integer  */
        "year",
        /** Integer  */
        "month",
        /** Integer  */
        "store_rank",
        /** BigDecimal  */
        "order_total",
        /** BigDecimal  */
        "order_total_with_discount",
        /** BigDecimal  */
        "delivery_total",
        /** BigDecimal  */
        "delivery_total_with_discount",
        /** BigDecimal  */
        "payment",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}