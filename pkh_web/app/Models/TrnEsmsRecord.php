<?php

namespace App\Models;



class TrnEsmsRecord extends BaseModel
{
    
    protected $table = "trn_esms_record";

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
        /** String  */
        "param",
         /** Long  */
         "ref_id",
          /** String  */
        "phone",
        /** String  */
        "type",
         /** String  */
         "temp_id",
        /** String  */
        "notes",
         /** String  */
        "code_result",
          /** String  */
        "SMSID",
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
