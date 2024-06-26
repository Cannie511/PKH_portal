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
class TrnEmployeeContract extends BaseModel {
	protected $table = "trn_employee_contract";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "id",
        /** Integer  */
        "employee_id",
        /** String  */
        "contract_no",
        /** String  */
        "title",
        /** LocalDate  */
        "start_date",
        /** LocalDate  */
        "end_date",
        /** BigDecimal  */
        "salary",
        /** BigDecimal  */
        "basic_salary",
        /** String  */
        "contract_type",
        /** String  */
        "notes",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}