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
class TrnAbsent extends BaseModel {
	protected $table = "trn_absent";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "id",
        /** Integer  */
        "user_id",
        /** LocalDate  */
        "absent_date",
        /** Double  */
        "amount",
        /** Integer  */
        "absent_type",
        /** Integer  */
        "leave_type",
        /** String  */
        "reason",
        /** String  */
        "status",
        /** Integer  */
        "approve_user_id",
        /** String  */
        "cmt",
        /** LocalDateTime  */
        "approve_ts",
        /** Integer  */
        "leave_allocation_id",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}