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
class TrnSalary extends BaseModel {
	protected $table = "trn_salary";

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
        /** Integer  */
        "id",
        /** LocalDate  */
        "salary_month",
        /** LocalDate  */
        "from_date",
        /** LocalDate  */
        "to_date",
        /** Integer  */
        "total_days",
        /** Integer  */
        "total_hours",
        /** BigDecimal  */
        "total_amount",
        /** BigDecimal  */
        "total_com_amount",
        /** BigDecimal  */
        "total_bhxh",
        /** BigDecimal  */
        "total_bhyt",
        /** BigDecimal  */
        "total_bhtn",
        /** BigDecimal  */
        "total_com_bhxh",
        /** BigDecimal  */
        "total_com_bhyt",
        /** BigDecimal  */
        "total_com_bhtn",
        /** BigDecimal  */
        "tax_bhxh_percent",
        /** BigDecimal  */
        "tax_bhyt_percent",
        /** BigDecimal  */
        "tax_bhtn_percent",
        /** BigDecimal  */
        "com_tax_bhxh_percent",
        /** BigDecimal  */
        "com_tax_bhyt_percent",
        /** BigDecimal  */
        "com_tax_bhtn_percent",
        /** BigDecimal  */
        "min_salary_area",
        /** String  */
        "salary_sts",
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