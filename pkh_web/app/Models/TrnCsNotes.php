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
class TrnCsNotes extends BaseModel {
	protected $table = "trn_cs_notes";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "id",
        /** Long  */
        "store_id",
        /** Long  */
        "pic_id",
        /** String  */
        "cus_review",
        /** String  */
        "com_resolve",
        /** String  */
        "cus_rating",
        /** String  */
        "com_rating",
        /** String  */
        "status",
        /** String  */
        "notes_1",
        /** String  */
        "notes_2",
        /** String  */
        "notes_3",
        /** LocalDateTime  */
        "deadline",
        /** LocalDateTime  */
        "completed_time",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}