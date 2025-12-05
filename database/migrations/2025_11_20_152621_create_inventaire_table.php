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
        Schema::create('inventaire', function (Blueprint $table) {
            $table->id();
            $table->integer('code_article')->unique();
            $table->string('title');
            $table->string('price');
            $table->string('size');
            $table->integer('stock');
            $table->unsignedBigInteger('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaire');
    }
};
