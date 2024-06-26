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
class MstProductCat extends BaseModel {
	protected $table = "mst_product_cat";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_cat_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "product_cat_id",
        /** Integer  */
        "supplier_id",
        /** String  */
        "product_cat_code",
        /** String  */
        "name",
        /** String  */
        "name_origin",
        /** String  */
        "short_content",
        /** byte[]  */
        "allow_order_flg",
        /** Integer  */
        "priority",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}