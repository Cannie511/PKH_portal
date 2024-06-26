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
class TrnImportWhStoreDetail extends BaseModel {
	protected $table = "trn_import_wh_store_detail";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'import_wh_store_id';
	//protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "import_wh_store_id",
        /** Long  */
        "product_id",
        /** Integer  */
        "amount",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}