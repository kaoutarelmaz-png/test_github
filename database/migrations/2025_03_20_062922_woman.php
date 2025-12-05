<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('womans', function (Blueprint $table) {
            $table->id();
            $table->integer('code_article_womans')->unique();
            $table->string('imager');
            $table->string('title');
            $table->string('content');
            $table->string('price');
            $table->string('size');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('womans'); // تأكد من أن الاسم متطابق
    }
};
