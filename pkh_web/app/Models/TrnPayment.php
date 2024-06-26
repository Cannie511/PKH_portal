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
class TrnPayment extends BaseModel {
	protected $table = "trn_customer_payment";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'cpayment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "cpayment_id",
        /** Integer  */
      
        /** Long  */
        "customer_id",
        /** LocalDate  */
        "cpayment_date",
        /** Integer  */
        "order_id",
        /** Integer  */
      
        /** BigDecimal  */
        "cpayment_money",
        /** Integer  */
        "bank_account_id",
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