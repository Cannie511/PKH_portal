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
class MstProductCat2 extends BaseModel {
	protected $table = "mst_product_cat2";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_cat2_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "product_cat1_id",
        "product_cat2_id",
        /** Integer  */
        "supplier_id",
        "name",
        /** String  */
        "notes",
        /** String  */
        
      
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}