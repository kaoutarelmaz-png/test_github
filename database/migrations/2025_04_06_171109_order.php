<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('prenom');
    $table->string('email')->nullable();
    $table->string('adresse');
    $table->string('phone');
    $table->decimal('totalgenerale', 10, 2);
    $table->enum('payment_method', ['delivery', 'cash'])->default('delivery');
    $table->string('bank_account')->nullable();
    $table->json('products'); // 👈 هذا الحقل لحفظ كل تفاصيل المنتجات
    $table->unsignedBigInteger('user_id')->nullable();
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
