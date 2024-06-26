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
class MstDepartment extends BaseModel {
	protected $table = "mst_department";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'department_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Long  */
        "department_id",
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