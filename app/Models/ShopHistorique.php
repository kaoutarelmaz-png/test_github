<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopHistorique extends Model
{
    protected $table = 'shop_historiques';

    public $timestamps = false;

    protected $fillable = [
        'shop_id',
        'code_article_shops',
        'imager',
        'title',
        'content',
        'price',
        'size',
        'stock',
        'action',
        'action_date',
    ];

    public function shop()
    {
        return $this->belongsTo(ShopModel::class, 'shop_id');
    }
}
