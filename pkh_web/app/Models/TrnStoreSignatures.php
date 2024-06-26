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
class TrnStoreSignatures extends BaseModel {
	protected $table = "trn_store_signatures";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'store_signature_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_signature_id",
        /** Long  */
        "store_id",
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