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
class TrnEtestAssign extends BaseModel {
	protected $table = "trn_etest_assign";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'etest_id';
	//protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "etest_id",
        /** Integer  */
        "user_id",
        /** LocalDate  */
        "from_date",
        /** LocalDate  */
        "to_date",
        /** Integer  */
        "mark",
        /** LocalDateTime  */
        "start_time",
        /** LocalDateTime  */
        "end_time",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}