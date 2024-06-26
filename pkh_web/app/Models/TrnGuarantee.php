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
class TrnGuarantee extends BaseModel {
	protected $table = "trn_guarantee";

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
        /** Long  */
        "id",
        /** Long  */
        "product_id",
        /** Integer  */
        "area1",
        /** Integer  */
        "area2",
        /** String  */
        "name",
        /** String  */
        "email",
        /** String  */
        "tel",
        /** String  */
        "store",
        /** LocalDate  */
        "purchase_date",
        /** String  */
        "ip",
        /** String  */
        "agent",
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