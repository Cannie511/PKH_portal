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
class TrnSupplierOrder extends BaseModel {
	protected $table = "trn_supplier_order";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'supplier_order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "supplier_order_id",
        /** Integer  */
        "supplier_id",
        /** LocalDate  */
        "order_date",
        /** LocalDate  */
        "total",
        
        /** BigDecimal  */
        "notes",
        /** BigDecimal  */
        "discount",
        /** BigDecimal  */
        "total_with_discount",
        /** Double  */
      
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}