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
class TrnWebOrder extends BaseModel {
	protected $table = "trn_web_order";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'web_order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "web_order_id",
        /** Long  */
        "user_web_id",
        /** BigDecimal  */
        "total",
        /** String  */
        "order_sts",
        /** String  */
        "notes",
        /** String  */
        "notes_cancel",
        /** Integer  */
        "salesman_id",
        /** LocalDateTime  */
        "cancel_time",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}