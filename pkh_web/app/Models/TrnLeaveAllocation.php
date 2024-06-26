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
class TrnLeaveAllocation extends BaseModel {
	protected $table = "trn_leave_allocation";

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
        /** Integer  */
        "id",
        /** Integer  */
        "employee_id",
        /** BigDecimal  */
        "num_days",
        /** String  */
        "reason",
        /** LocalDate  */
        "expired_date",
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