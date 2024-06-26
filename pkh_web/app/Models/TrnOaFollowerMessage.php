<?php

namespace App\Models;


class TrnOaFollowerMessage  extends BaseModel 
{
    protected $table = "trn_oa_follower_message";

	/**
     * The primary key for the model.
     *
     * @var string
     */
	protected $primaryKey = 'oa_follower_message_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /** Integer  */
        "oa_follower_message_id",
        /** String */
        "content",
        /** BigDecimal  */
        "total",
      /** BigDecimal  */
        "total_sent",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
