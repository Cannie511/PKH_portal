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
class TrnStoreCheckInImages extends BaseModel {
	protected $table = "trn_store_check_in_images";

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
        /** Long  */
        "check_in_id",
        /** String  */
        "img_path",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}