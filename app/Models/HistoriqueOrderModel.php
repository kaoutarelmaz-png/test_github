<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueOrderModel extends Model
{
    protected $table = 'HistoriqueOrder'; // اسم الجدول في قاعدة البيانات

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'adresse',
        'phone',
        'totalgenerale',
        'select',
        'bankAccount',
        'created_at', // إذا أردت الاحتفاظ بنفس تاريخ الإنشاء
    ];
}
