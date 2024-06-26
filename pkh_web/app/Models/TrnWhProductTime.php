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
class TrnWhProductTime extends BaseModel {
	protected $table = "trn_wh_product_time";

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
        /** LocalDate  */
        "in_date",
        /** Long  */
        "product_id",
        /** Integer  */
        "amount",
        /** Integer  */
        "remain",
        /** Long  */
        "supplier_delivery_id",
        /** LocalDate  */
        "soldout_date",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}