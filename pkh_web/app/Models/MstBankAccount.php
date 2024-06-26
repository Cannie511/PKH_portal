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
class MstBankAccount extends BaseModel {
	protected $table = "mst_bank_account";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'bank_account_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "bank_account_id",
        /** Long  */
        "store_id",
        /** String  */
        "bank_name",
        /** String  */
        "bank_branch",
        /** String  */
        "bank_account_no",
        /** String  */
        "bank_account_name",
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