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
class TrnEtestSentence extends BaseModel {
	protected $table = "trn_etest_sentence";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'etest_id';
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
        "seq_no",
        /** String  */
        "seq_type",
        /** String  */
        "question",
        /** String  */
        "answer",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}