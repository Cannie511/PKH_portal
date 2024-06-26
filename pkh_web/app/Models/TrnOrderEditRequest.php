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
class TrnOrderEditRequest extends BaseModel {
	protected $table = "trn_order_edit_request";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'request_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "request_id",
        /** LocalDate  */
        "request_date",
        /** Integer  */
        "request_type",
        /** Integer  */
        "request_sts",
        /** Long  */
        "ref_id",
        /** String  */
        "request_notes",
        /** String  */
        "response_notes",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}