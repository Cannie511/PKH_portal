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
class TrnAuditLog extends BaseModel {
	protected $table = "trn_audit_log";

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
        /** Integer  */
        "user_id",
        /** String  */
        "ip",
        /** String  */
        "event_name",
        /** String  */
        "agent",
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
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}