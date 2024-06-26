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
class UserWeb extends BaseModel {
	protected $table = "users_web";

	/**
     * The primary key for the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** LocalDate  */
        "name",
        /** Long  */
        "email",
        /** Integer  */
        "phone_number",
        "area1",
        "area2",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}