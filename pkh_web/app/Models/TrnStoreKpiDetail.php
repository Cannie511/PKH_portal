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
class TrnStoreKpiDetail extends BaseModel {
	protected $table = "trn_store_kpi_detail";

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
        "kpi_id",
        /** Integer  */
        "month_index",
        /** Long  */
        "product_id",
        /** Integer  */
        "seq_no",
        /** Integer  */
        "amount",
        /** BigDecimal  */
        "unit_price",
        /** Integer  */
        "result_amount",
        /** BigDecimal  */
        "result_money",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}