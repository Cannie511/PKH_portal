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
class TrnProductPriceHis extends BaseModel {
	protected $table = "trn_product_price_his";

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
        "product_id",
        /** BigDecimal  */
        "selling_price",
        /** BigDecimal  */
        "selling_price_sample",
        /** BigDecimal  */
        "selling_price_tax",
        /** Integer  */
        "change_user_id",
        /** LocalDateTime  */
        "change_time",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}