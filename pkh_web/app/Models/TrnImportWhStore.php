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
class TrnImportWhStore extends BaseModel {
	protected $table = "trn_import_wh_store";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'import_wh_store_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "import_wh_store_id",
        /** Integer  */
        "import_type",
        /** Long  */
        "store_id",
        /** Long  */
        "warehouse_id",
        /** LocalDate  */
        "import_date",
        /** BigDecimal  */
        "total",
        /** String  */
        "notes",
        /** String  */
        "import_sts",
        /** Integer  */
        "salesman_id",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}