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
class MstPromotion extends BaseModel {
	protected $table = "mst_promotion";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'promotion_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "promotion_id",
        /** LocalDate  */
        "from_date",
        /** LocalDate  */
        "to_date",
        /** String  */
        "promotion_name",
        /** Integer  */
        "promotion_type",
        /** Integer  */
        "promotion_sts",
        /** String  */
        "description",
        /** String  */
        "meta_data",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}