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
        Schema::create('HistoriqueOrder',function(Blueprint $table){
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email')->nullable();
            $table->string('adresse')->nullable();
            $table->string('phone')->nullable();
            $table->json('products');
            $table->string('select')->nullable();
            $table->string('bankAccount')->nullable();
            $table->decimal('totalgenerale', 8, 2)->nullable();
            // $table->date(column: 'datecreateorder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
