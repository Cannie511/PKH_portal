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
class TrnSupplierOrderDetail extends BaseModel {
	protected $table = "trn_supplier_order_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'supplier_order_id';
	//protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "supplier_order_detail_id",
        "supplier_order_id",
        /** Long  */
        "product_id",
        /** Integer  */
        "pakaging",
        /** Integer  */
        "amount",
        /** BigDecimal  */
        "unit_price",
        /** BigDecimal  */
        "describes",
        /** Double  */
        "pakaging_type",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}