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
class TrnStorePaymentStatus extends BaseModel {
	protected $table = "trn_store_payment_status";

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
        /** Long  */
        "store_delivery_id",
        /** LocalDate  */
        "delivery_date",
        /** BigDecimal  */
        "delivery_amount",
        /** BigDecimal  */
        "remain_amount",
        /** LocalDate  */
        "payment_start",
        /** LocalDate  */
        "payment_end",
        /** LocalDate  */
        "payment_date",
        /** String  */
        "sts",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}