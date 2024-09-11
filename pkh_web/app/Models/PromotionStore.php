<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionStore extends Model
{
   
    protected $fillable = [
       'store_id',
        'year',
        'quarter',
        'total_score_card',
        'discount',
        'voucher',
        'type_promotion',
    ];
}