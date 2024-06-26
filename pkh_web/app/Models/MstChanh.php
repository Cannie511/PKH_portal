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
class MstChanh extends BaseModel {
	protected $table = "mst_chanh";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'chanh_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "chanh_id",
        /** String  */
        "name",
        /** String  */
        "address",
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
        /** String  */
        "chanh_sts",
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