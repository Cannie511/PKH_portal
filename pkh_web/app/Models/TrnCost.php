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
class TrnCost extends BaseModel {
	protected $table = "trn_cost";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'cost_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "cost_id",
        /** Long  */
        "cost_cat_id",
        /** Long  */
        "department_id",
        /** LocalDate  */
        "cost_date",
        /** BigDecimal  */
        "amount",
        /** String  */
        "contra_account",
        /** String  */
        "voucher",
        /** String  */
        "description",
         /** LocalDate  */
        "confirm_time" ,
         /** LocalDate  */
        "cancel_time" ,
        /** Text  */
        "request_notes" ,
          /** Text  */
        "confirm_notes" ,
          /** Text  */
        "cancel_notes" ,
        /** Long  */
        "confirm_by",
        /** String  */
        "cost_sts" ,
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}