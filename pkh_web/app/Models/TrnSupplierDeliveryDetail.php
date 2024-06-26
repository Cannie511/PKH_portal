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
class TrnSupplierDeliveryDetail extends BaseModel {
	protected $table = "trn_supplier_delivery_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'supplier_delivery_id';
	//protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "supplier_delivery_id",
        /** Long  */
        "product_id",
        /** Integer  */
        "seq_no",
        /** Integer  */
        "amount",
        /** BigDecimal  */
        "price",
        /** BigDecimal  */
        "price_vi",
        /** BigDecimal  */
        "duty_tax",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}