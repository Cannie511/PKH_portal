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
class TrnAttendance extends BaseModel {
	protected $table = "trn_attendance";

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
        /** Integer  */
        "user_id",
        /** String  */
        "ip",
        /** String  */
        "agent",
        /** String  */
        "event_name",
        /** String  */
        "notes",
        /** String  */
        "ip_as",
        /** String  */
        "ip_city",
        /** String  */
        "ip_country",
        /** String  */
        "ip_country_code",
        /** String  */
        "ip_isp",
        /** BigDecimal  */
        "ip_lat",
        /** BigDecimal  */
        "ip_lon",
        /** String  */
        "ip_org",
        /** String  */
        "ip_region",
        /** String  */
        "ip_region_name",
        /** String  */
        "ip_timezone",
        /** String  */
        "ip_zip",
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