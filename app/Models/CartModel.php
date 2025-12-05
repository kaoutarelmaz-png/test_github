<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $fillable=['imager','title','content','size','price','quantite','Total','user_id'];
    protected $table='carts';

    protected $casts = [
    'products' => 'array',
    ];


        public function mens(){
            return $this->belongsTo(MenModel::class,'IDmen');
        }
        public function womans(){
        return $this->belongsTo(WomenModel::class,'IDwoman');
    }
    public function shops(){
        return $this->belongsTo(ShopModel::class,'IDshop');
    }

    public function order()
    {
        return $this->belongsTo(OrderModel::class);
    }

}
