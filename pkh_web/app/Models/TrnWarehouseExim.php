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
class TrnWarehouseExim extends BaseModel {
	protected $table = "trn_warehouse_exim";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'warehouse_exim_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "warehouse_exim_id",
        /** Long  */
        "from_warehouse_id",
        /** Long  */
        "to_warehouse_id",
        /** String  */
        "warehouse_exim_code",
        /** BigDecimal  */
        "total",
        /** BigDecimal  */
        "volume",
        /** BigDecimal  */
        "carton",
        /** Integer  */
        "seq_no",
        /** String  */
        "exim_sts",
        /** String  */
        "notes",
        /** String  */
        "notes_cancel",
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