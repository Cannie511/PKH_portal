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
class TrnStoreKpi extends BaseModel {
	protected $table = "trn_store_kpi";

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
        /** Long  */
        "store_id",
        /** Integer  */
        "year",
        /** BigDecimal  */
        "target_year",
        /** BigDecimal  */
        "result_year",
        /** Integer  */
        "discount",
        /** BigDecimal  */
        "month_1_target",
        /** BigDecimal  */
        "month_2_target",
        /** BigDecimal  */
        "month_3_target",
        /** BigDecimal  */
        "month_4_target",
        /** BigDecimal  */
        "month_5_target",
        /** BigDecimal  */
        "month_6_target",
        /** BigDecimal  */
        "month_7_target",
        /** BigDecimal  */
        "month_8_target",
        /** BigDecimal  */
        "month_9_target",
        /** BigDecimal  */
        "month_10_target",
        /** BigDecimal  */
        "month_11_target",
        /** BigDecimal  */
        "month_12_target",
        /** BigDecimal  */
        "month_1_result",
        /** BigDecimal  */
        "month_2_result",
        /** BigDecimal  */
        "month_3_result",
        /** BigDecimal  */
        "month_4_result",
        /** BigDecimal  */
        "month_5_result",
        /** BigDecimal  */
        "month_6_result",
        /** BigDecimal  */
        "month_7_result",
        /** BigDecimal  */
        "month_8_result",
        /** BigDecimal  */
        "month_9_result",
        /** BigDecimal  */
        "month_10_result",
        /** BigDecimal  */
        "month_11_result",
        /** BigDecimal  */
        "month_12_result",
        /** String  */
        "kpi_sts",
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