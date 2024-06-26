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
class TrnSupplierDelivery extends BaseModel {
	protected $table = "trn_supplier_delivery";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'supplier_delivery_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "supplier_delivery_id",
        /** Long  */
        "supplier_order_id",
        /** Integer  */
        "supplier_id",
        /** String  */
        "pi_no",
        /** LocalDate  */
        "delivery_date",
        /** String  */
        "contract_no",
        /** LocalDate  */
        "payment_1_date",
        /** LocalDate  */
        "finish_cont_date",
        /** LocalDate  */
        "deliver_cont_date",
        /** LocalDate  */
        "arrive_port_date",
        /** LocalDate  */
        "comming_pkh_date",
        /** LocalDate  */
        "payment_2_date",
        /** LocalDate  */
        "finish_cont_expected_date",
        /** LocalDate  */
        "deliver_cont_expected_date",
        /** LocalDate  */
        "arrive_port_expected_date",
        /** LocalDate  */
        "comming_pkh_expected_date",
        /** LocalDate  */
        "payment_2_expected_date",
        /** Integer  */
        "payment_1_percent",
        /** Integer  */
        "payment_2_duration",
        /** BigDecimal  */
        "insurance_cost",
        /** Integer  */
        "delivery_sts",
        /** BigDecimal  */
        "volume",
        /** String  */
        "notes",
        /** BigDecimal  */
        "total",
        /** BigDecimal  */
        "total_vi",
        /** Double  */
        "rate",
        /** BigDecimal  */
        "total_duty_vi",
        /** BigDecimal  */
        "duty_tax",
        /** BigDecimal  */
        "vat_tax",
        /** BigDecimal  */
        "frieght_cost",
        /** BigDecimal  */
        "landed_cost",
        /** LocalDateTime  */
        "cancel_time",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}