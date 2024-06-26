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
class TrnStoreDeliveryPayment extends BaseModel {
	protected $table = "trn_store_delivery_payment";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'trn_store_delivery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "trn_store_delivery",
        /** LocalDate  */
        "delivery_date",
        /** BigDecimal  */
        "total",
        /** BigDecimal  */
        "total_with_discount",
        /** Integer  */
        "payment_sts",
        /** BigDecimal  */
        "payment_amount",
        /** LocalDate  */
        "payment_finish_date",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}