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
class TrnWarehouseChange extends BaseModel {
	protected $table = "trn_warehouse_change";

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
        /** Integer  */
        "warehouse_change_type",
        /** Long  */
        "product_id",
        /** Long  */
       
        /** LocalDate  */
        "changed_date",
        /** Integer  */
        "amount",
       
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}