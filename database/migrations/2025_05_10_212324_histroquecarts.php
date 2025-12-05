<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
 Schema::create("Histroquecarts", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->string('action'); // INSERT أو UPDATE
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable(); // بدون ->after()
            $table->string('imager');
            $table->string('title');
            $table->string('content');
            $table->string('size');
            $table->string('price');
            $table->integer('quantite');
            $table->integer("Total");
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("Histroquecarts");
    }
};
