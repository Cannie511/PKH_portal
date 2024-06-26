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
class MstPackaging extends BaseModel {
	protected $table = "mst_packaging";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'packaging_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "packaging_id",
        /** String  */
        "name",
        /** Integer  */
        "length",
        /** Integer  */
        "width",
        /** Integer  */
        "height",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}