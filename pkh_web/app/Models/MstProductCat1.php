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
class MstProductCat1 extends BaseModel {
	protected $table = "mst_product_cat1";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_cat1_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "product_cat1_id",
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