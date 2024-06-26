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
class MstProduct extends BaseModel {
	protected $table = "mst_product";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "product_id",
        /** Integer  */
        "product_cat1_id",
        "product_cat2_id" , 
        "supplier_id",
        /** Integer  */
        "product_name",
        /** String  */
        "product_code",
        /** String  */
        "describes",
        /** String  */
        "color",
        /** String  */
        "pakaging",
        /** String  */
        "import_price",
        /** String  */
        "selling_price",
        /** String  */
        "img",
        /** Integer  */
        "notes",
        /** Integer  */
        "pakagingType",
        /** Integer  */
        "warranty",
        /** Integer  */
      
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}