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
class MstDealer extends BaseModel {
	protected $table = "mst_dealer";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'dealer_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "dealer_id",
        /** String  */
        "name",
        /** String  */
        "address",
        /** Integer  */
        "area1",
        /** Integer  */
        "area2",
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
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}