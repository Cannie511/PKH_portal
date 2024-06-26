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
class Permissions extends BaseModel {
	protected $table = "permissions";

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
        /** String  */
        "model",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}