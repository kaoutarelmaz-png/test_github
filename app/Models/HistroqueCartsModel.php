<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistroqueCartsModel extends Model
{
     protected $table = 'Histroquecarts';

    protected $fillable = [
        'cart_id',
        'action',
        'user_id',
        'imager',
        'title',
        'content',
        'size',
        'price',
        'quantite',
        'Total',
    ];

    // public $timestamps = true;

    public function order(){
        return $this->belongsTo(OrderModel::class,'IDorder');
    }
}
