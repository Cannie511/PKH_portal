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
class TrnBranchExport extends BaseModel {
	protected $table = "trn_branch_export";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'branch_export_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "branch_export_id",
        /** Long  */
        "branch_id_from",
        /** Long  */
        "branch_id_to",
        /** String  */
        "branch_export_code",
        /** BigDecimal  */
        "total",
        /** BigDecimal  */
        "total_with_discount",
        /** Integer  */
        "seq_no",
        /** String  */
        "export_sts",
        /** String  */
        "notes",
        /** LocalDateTime  */
        "cancel_time",
        /** Long  */
        "warehouseman_id",
        /** Long  */
        "shipping_id",
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
        /** Long  */
        "packing_by",
        /** Long  */
        "confirm_by",
        /** Long  */
        "delivery_by",
        /** Long  */
        "shipping_by",
        /** Long  */
        "receive_by",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}