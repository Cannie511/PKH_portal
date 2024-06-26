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
class MstDeliveryVendor extends BaseModel {
	protected $table = "mst_delivery_vendor";

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
        /** String  */
        "delivery_vendor_name",
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