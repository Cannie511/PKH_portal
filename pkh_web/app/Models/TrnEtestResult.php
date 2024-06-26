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
class TrnEtestResult extends BaseModel {
	protected $table = "trn_etest_result";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'etest_id';
	//protected $primaryKey = 'user_id';
	//protected $primaryKey = 'seq_no';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "etest_id",
        /** Integer  */
        "user_id",
        /** Integer  */
        "seq_no",
        /** String  */
        "answer",
        /** Integer  */
        "mark",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}