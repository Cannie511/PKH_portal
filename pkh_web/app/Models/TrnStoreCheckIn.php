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
class TrnStoreCheckIn extends BaseModel {
	protected $table = "trn_store_check_in";

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
        /** LocalDateTime  */
        "working_time",
        /** Long  */
        "store_id",
        /** Integer  */
        "salesman_id",
        /** String  */
        "notes",
        /** Double  */
        "gps_lat",
        /** Double  */
        "gps_long",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}