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
class TrnWorkingHours extends BaseModel {
	protected $table = "trn_working_hours";

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
        "working_date",
        /** LocalTime  */
        "start_time",
        /** LocalTime  */
        "end_time",
        /** LocalTime  */
        "first_time",
        /** LocalTime  */
        "last_time",
        /** Integer  */
        "working_hours",
        /** Integer  */
        "absent_type",
        /** byte[]  */
        "is_holiday",
        /** Integer  */
        "holiday_hours",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}