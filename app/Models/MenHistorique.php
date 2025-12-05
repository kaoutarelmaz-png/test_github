<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenHistorique extends Model
{
        protected $table = 'men_historiques'; // اسم الجدول في قاعدة البيانات

    public $timestamps = false; // لأنك تستخدم حقل 'action_date' بدلاً من created_at/updated_at

    protected $fillable = [
        'men_id',
        'imager',
        'title',
        'content',
        'price',
        'size',
        'stock',
        'action',
        'action_date',
        'code_article_mens',
    ];

    // علاقة مع الجدول الأصلي (اختياري)
    public function men()
    {
        return $this->belongsTo(MenModel::class, 'men_id');
    
}
}