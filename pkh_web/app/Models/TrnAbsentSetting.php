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
class TrnAbsentSetting extends BaseModel {
	protected $table = "trn_absent_setting";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'user_id';
	//protected $primaryKey = 'setting_year';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "user_id",
        /** Integer  */
        "setting_year",
        /** Double  */
        "amount",
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