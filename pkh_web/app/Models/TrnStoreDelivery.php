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
class TrnStoreDelivery extends BaseModel {
	protected $table = "trn_store_delivery";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'store_delivery_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "store_delivery_id",
        /** Long  */
        "store_order_id",
        /** Long  */
        "store_id",
        /** Long  */
        "warehouse_id",
        /** LocalDate  */
        "delivery_date",
        /** BigDecimal  */
        "discount_1",
        /** BigDecimal  */
        "discount_2",
        /** BigDecimal  */
        "total",
        /** BigDecimal  */
        "total_with_discount",
        /** BigDecimal  */
        "volume",
        /** BigDecimal  */
        "carton",
        /** Integer  */
        "seq_no",
        /** Integer  */
        "delivery_seq_no",
        /** String  */
        "delivery_sts",
        /** String  */
        "notes",
        /** String  */
        "notes_cancel",
        /** LocalDateTime  */
        "cancel_time",
        /** Integer  */
        "salesman_id",
        /** Long  */
        "promotion_id",
        /** Long  */
        "branch_id",
        /** Long  */
        "supplier_id",
        /** Long  */
        "shipping_id",
        /** Integer  */
        "order_type",
        /** LocalDateTime  */
        "packing_time",
        /** LocalDateTime  */
        "confirm_time",
        /** LocalDateTime  */
        "delivery_time",
        /** LocalDateTime  */
        "shipping_time",
        /** LocalDateTime  */
        "receive_time",
        /** LocalDateTime  */
        "finish_time",
        /** Integer  */
        "packing_by",
        /** Integer  */
        "confirm_by",
        /** Integer  */
        "delivery_by",
        /** Integer  */
        "shipping_by",
        /** Integer  */
        "receive_by",
        /** Integer  */
        "finish_by",
        /** String  */
        "store_delivery_code",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}