<?php
/**
 * Copyright(c) ICHIVINA Co. VN, Ltd. All Rights Reserved.
 */

namespace App\Models;

/**
 * 
 * @author Nguyen Phu Cuong
 *
 */
class Roles extends BaseModel {
	protected $table = "roles";

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
        /** Integer  */
        "id",
        /** String  */
        "name",
        /** String  */
        "slug",
        /** String  */
        "description",
        /** Integer  */
        "level",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}