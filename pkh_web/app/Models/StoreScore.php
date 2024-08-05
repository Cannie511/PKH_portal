<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreScore extends Model
{
   
    protected $fillable = [
        'store_id',
        'year',
        'quarter',
        'sale_score',
        'retention_score',
        'order_score',
        'dept_score',
        'total_score_card',
    ];
}
