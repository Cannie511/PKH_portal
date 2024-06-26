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
class DownloadManagement extends BaseModel {
	protected $table = "download_management";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'download_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "download_id",
        /** String  */
        "screen",
        /** String  */
        "descript",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}