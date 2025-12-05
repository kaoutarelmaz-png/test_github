<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WomenModel extends Model
{
    protected $fillable=['imager','title','content','price','size','stock','code_article_womans'];
    protected $table='womans';

    public function carts()
    {
        return $this->hasMany(CartModel::class, 'woman_id');
    }
}
