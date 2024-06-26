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
class TrnSalaryDetail extends BaseModel {
	protected $table = "trn_salary_detail";

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
        /** Integer  */
        "salary_id",
        /** Integer  */
        "total_days",
        /** Integer  */
        "total_hours",
        /** Integer  */
        "count_dependent_person",
        /** BigDecimal  */
        "overtime_hour",
        /** BigDecimal  */
        "gross_salary",
        /** BigDecimal  */
        "basic_salary",
        /** BigDecimal  */
        "real_salary",
        /** BigDecimal  */
        "overtime_salary",
        /** BigDecimal  */
        "bonus",
        /** BigDecimal  */
        "tax_bhxh",
        /** BigDecimal  */
        "tax_bhyt",
        /** BigDecimal  */
        "tax_bhtn",
        /** BigDecimal  */
        "tax_pit",
        /** BigDecimal  */
        "tax_pit_edit",
        /** BigDecimal  */
        "minus_amount",
        /** BigDecimal  */
        "advance",
        /** BigDecimal  */
        "net_salary",
        /** BigDecimal  */
        "com_tax_bhxh",
        /** BigDecimal  */
        "com_tax_bhyt",
        /** BigDecimal  */
        "com_tax_bhtn",
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