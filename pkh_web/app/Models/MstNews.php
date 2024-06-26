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
class MstNews extends BaseModel {
	protected $table = "mst_news";

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
        /** LocalDate  */
        "publish_date",
        /** String  */
        "slug",
        /** String  */
        "title",
        /** String  */
        "description",
        /** String  */
        "keywords",
        /** String  */
        "short_content",
        /** String  */
        "content",
        /** String  */
        "image_path",
        /** String  */
        "feature_image_path",
        /** byte[]  */
        "show_flg",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}