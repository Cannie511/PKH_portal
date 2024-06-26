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
class TrnCustomerPayment extends BaseModel {
	protected $table = "trn_customer_payment";

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
        "cpayment_id",
        "cpayment_date",
        "cpayment_money",
        /** Long  */
        "customer_id",
        /** Long  */
        "notes",
        /** String  */
        "total",
        
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}