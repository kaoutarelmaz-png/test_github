<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'orders'; // اسم الجدول

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'adresse',
        'phone',
        'totalgenerale',
        'payment_method',
        'bank_account',
        'products', // حقل JSON لحفظ تفاصيل المنتجات
        'user_id',
    ];

    // لتحويل حقل products تلقائيًا إلى Array عند جلبه من قاعدة البيانات
    protected $casts = [
        'products' => 'array',
    ];

    // علاقة مع المستخدم (اختياري)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
