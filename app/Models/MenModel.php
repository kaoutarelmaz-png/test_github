<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenModel extends Model
{
    protected $fillable=['imager','title','content','price','size','stock','code_article_mens'];
    protected $table='mens';

    public function carts()
{
    return $this->hasMany(CartModel::class, 'men_id');
}
}
