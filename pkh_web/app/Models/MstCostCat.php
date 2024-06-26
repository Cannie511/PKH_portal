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
class MstCostCat extends BaseModel {
	protected $table = "mst_cost_cat";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'cost_cat_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "cost_cat_id",
        /** Long  */
        "parent_id",
        /** String  */
        "name",
        /** String  */
        "description",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}