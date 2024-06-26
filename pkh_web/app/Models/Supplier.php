<?php

// use Illuminate\Foundation\Auth\User as Authenticatable;

namespace App\Models;

class Supplier extends BaseModel
{
    protected $table = "mst_supplier";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "short_name", 
        "contact_name", "contact_email", "contact_tel",
        "contact_mobile1", "contact_mobile2"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
