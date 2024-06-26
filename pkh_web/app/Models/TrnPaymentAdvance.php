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
class TrnPaymentAdvance extends BaseModel {
	protected $table = "trn_payment_advance";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'payment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "payment_id",
        /** Integer  */
        "salesman_id",
        /** Long  */
        "store_id",
        /** LocalDate  */
        "payment_date",
        /** Integer  */
        "payment_type",
        /** String  */
        "payment_sts",
        /** BigDecimal  */
        "payment_money",
        /** Integer  */
        "bank_account_id",
        /** String  */
        "notes",
        /** BigDecimal  */
        "discount",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}