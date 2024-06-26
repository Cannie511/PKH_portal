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
class TrnImportWhFactory extends BaseModel {
	protected $table = "trn_import_wh_factory";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'import_wh_factory_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "import_wh_factory_id",
        /** Long  */
        "warehouse_id",
        /** Long  */
        "supplier_id",
        /** LocalDate  */
        "import_date",
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