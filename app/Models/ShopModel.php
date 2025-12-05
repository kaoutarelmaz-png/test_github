<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{
    protected $fillable=['imager','title','content','price','size','stock','code_article_shops'];
    protected $table='shops';
    public function carts()
{
    return $this->hasMany(CartModel::class, 'shop_id');
}
}
