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
class TrnInternalNewsViewed extends BaseModel {
	protected $table = "trn_internal_news_viewed";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'user_id';
	//protected $primaryKey = 'news_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "user_id",
        /** Long  */
        "news_id",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}