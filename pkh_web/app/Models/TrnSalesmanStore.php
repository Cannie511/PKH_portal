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
class TrnSalesmanStore extends BaseModel {
	protected $table = "trn_salesman_store";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'salesman_store_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "salesman_store_id",
        /** Integer  */
        "salesman_id",
        /** Long  */
        "store_id",
        /** LocalDate  */
        "start_date",
        /** LocalDate  */
        "end_date",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}