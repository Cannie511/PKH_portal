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
class TrnCheckWarehouseDetail extends BaseModel {
	protected $table = "trn_check_warehouse_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "check_warehouse_id",
        /** Long  */
        "product_id",
        /** Integer  */
        "seq_no",
        /** Integer  */
        "amount",
        /** BigDecimal  */
        "unit_price",
        /** String  */
        "notes",
        /** String  */
        "notes_2",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}