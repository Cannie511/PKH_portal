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
class TrnProductMarketHis extends BaseModel {
	protected $table = "trn_product_market_his";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_market_his_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "product_market_his_id",
        /** Integer  */
        "warehouse_change_type",
        /** Long  */
        "product_market_id",
        /** LocalDate  */
        "changed_date",
        /** BigDecimal  */
        "price",
        /** Integer  */
        "amount",
        /** Long  */
        "store_id",
        /** Integer  */
        "status",
        /** String  */
        "description",
        /** String  */
        "description_approve",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}