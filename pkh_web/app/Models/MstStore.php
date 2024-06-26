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
class MstStore extends BaseModel {
	protected $table = "mst_store";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'store_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_id",
        /** String  */
        "name",
        /** String  */
        "address",
        /** BigDecimal  */
        "discount",
        /** Integer  */
        "level",
        /** Integer  */
        "area1",
        /** Integer  */
        "area2",
        /** Double  */
        "gps_lat",
        /** Double  */
        "gps_long",
        /** String  */
        "img_path",
        /** Long  */
        "new_store_id",
        /** Long  */
        "dealer_id",
        /** String  */
        "store_sts",
        /** String  */
        "tax_code",
        /** String  */
        "notes",
        /** Long  */
        "chanh_id",
        /** String  */
        "address_chanh",
        /** Double  */
        "gps_lat_chanh",
        /** Double  */
        "gps_long_chanh",
        /** String  */
        "contact_name",
        /** String  */
        "contact_email",
        /** String  */
        "contact_tel",
        /** String  */
        "contact_fax",
        /** String  */
        "contact_mobile1",
        /** String  */
        "contact_mobile2",
        /** String  */
        "bank_name",
        /** String  */
        "bank_branch",
        /** String  */
        "bank_account_no",
        /** String  */
        "bank_account_name",
        /** Integer  */
        "salesman_id",
        /** byte[]  */
        "inner_flg",
        /** LocalDate  */
        "first_order",
        /** String  */
        "accountant_store_id",
        /** String  */
        "zalo_user_id",
        /** String  */
        "review_sts",
        /** Integer  */
        "review_user_id",
        /** LocalDate  */
        "review_date",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}