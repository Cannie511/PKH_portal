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
class TrnStoreDeliverySign extends BaseModel {
	protected $table = "trn_store_delivery_sign";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'store_delivery_sign_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_delivery_sign_id",
        /** Long  */
        "store_delivery_id",
        /** String  */
        "img_path",
        /** String  */
        "description",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}