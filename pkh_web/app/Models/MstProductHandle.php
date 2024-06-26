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
class MstProductHandle extends BaseModel {
	protected $table = "mst_product_handle";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_handle_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "product_handle_id",
        /** String  */
        "name",
        /** Integer  */
        "supplier_id",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}