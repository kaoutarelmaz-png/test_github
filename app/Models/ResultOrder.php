<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultOrder extends Model
{
    protected $table = 'resultOrder';
    public $timestamps = false;
    protected $fillable = [
        'source_table', 'action', 'source_id',
        'cart_id', 'user_id', 'imager', 'title', 'content',
        'price', 'quantite', 'Total', 'created_at',
        'nom', 'prenom', 'email', 'adresse', 'phone',
        'totalgenerale', 'select', 'bankAccount',
    ];
}
