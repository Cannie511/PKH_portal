<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstOaFollower extends Model
{
    protected $table = "mst_oa_follower";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'oa_follower_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'oa_follower_id'
        ,'store_id'
        , 'avatar'
        , 'user_id'
        , 'user_id_by_app'
        , 'display_name'
        , 'birth_date'
        ,"notes"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];


}
