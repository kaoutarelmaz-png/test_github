<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidatedOrder extends Model
{
    protected $table = 'validated_orders'; // اسم الجدول في قاعدة البيانات

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'adresse',
        'phone',
        'products',
        'totalgenerale',
        'select',
        'bankAccount',
        'created_at', // إذا أردت الاحتفاظ بنفس تاريخ الإنشاء
    ];

    protected $casts = [
    'products' => 'array',
];


    public $timestamps = false; // إذا لم تكن تستخدم created_at و updated_at تلقائياً
}
