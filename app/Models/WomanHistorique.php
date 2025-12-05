<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WomanHistorique extends Model
{
    protected $table = 'woman_historiques';

    public $timestamps = false;

    protected $fillable = [
        'woman_id',
        'imager',
        'title',
        'content',
        'price',
        'size',
        'stock',
        'action',
        'action_date',
        'code_article_womens',
    ];

    public function woman()
    {
        return $this->belongsTo(WomenModel::class, 'woman_id');
    }
}
