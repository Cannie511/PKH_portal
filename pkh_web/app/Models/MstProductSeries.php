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
class MstProductSeries extends BaseModel {
	protected $table = "mst_product_series";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_id';
	//protected $primaryKey = 'product_detail_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "product_id",
        /** Long  */
        "product_detail_id",
        /** BigDecimal  */
        "selling_price",
        /** BigDecimal  */
        "selling_price_tax",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}