<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventtaireModel extends Model
{
    protected $fillable=['code_article','title','price','size','stock','quantite'];
    protected $table='inventaire';
}
