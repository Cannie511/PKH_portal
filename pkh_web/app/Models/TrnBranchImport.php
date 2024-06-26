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
class TrnBranchImport extends BaseModel {
	protected $table = "trn_branch_import";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'branch_import_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "branch_import_id",
        /** Long  */
        "branch_id_from",
        /** Long  */
        "branch_id_to",
        /** String  */
        "branch_import_code",
        /** BigDecimal  */
        "total",
        /** BigDecimal  */
        "total_with_discount",
        /** Integer  */
        "seq_no",
        /** String  */
        "import_sts",
        /** String  */
        "notes",
        /** LocalDateTime  */
        "cancel_time",
        /** Long  */
        "warehouseman_id",
        /** LocalDateTime  */
        "confirm_time",
        /** LocalDateTime  */
        "import_time",
        /** Long  */
        "confirm_by",
        /** Long  */
        "import_by",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}