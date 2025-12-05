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
        Schema::create('mens', function (Blueprint $table) {
            $table->id();
            $table->integer('code_article_mens')->unique();
            $table->string('imager');
            $table->string('title');
            $table->string('content');
            $table->integer('price');
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
        Schema::dropIfExists('mens'); // تأكد من أن الاسم متطابق
    }
};
