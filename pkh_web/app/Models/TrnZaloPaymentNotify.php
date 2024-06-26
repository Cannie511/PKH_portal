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
class TrnZaloPaymentNotify extends BaseModel {
	protected $table = "trn_zalo_payment_notify";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'notify_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "notify_id",
        /** Long  */
        "payment_id",
        /** String  */
        "content",
        /** String  */
        "zalo_sts",
        /** String  */
        "zalo_notes",
        /** String  */
        "phone_number",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}