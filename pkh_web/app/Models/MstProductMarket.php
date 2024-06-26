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
class MstProductMarket extends BaseModel {
	protected $table = "mst_product_market";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'product_market_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "product_market_id",
        /** Integer  */
        "type",
        /** String  */
        "code",
        /** String  */
        "name",
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