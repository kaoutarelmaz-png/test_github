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
        DB::unprepared('
                    CREATE TRIGGER trg_order_insert 
            AFTER INSERT ON validated_orders
            FOR EACH ROW
            BEGIN
                INSERT INTO HistoriqueOrder(
                    nom,
                    prenom,
                    email,
                    adresse,
                    phone,
                    products,
                    `select`,
                    bankAccount,
                    totalgenerale,
                    created_at,
                    updated_at
                )
                VALUES (
                    NEW.nom,
                    NEW.prenom,
                    NEW.email,
                    NEW.adresse,
                    NEW.phone,
                    NEW.products,
                    NEW.`select`,
                    NEW.bankAccount,
                    NEW.totalgenerale,
                    NEW.created_at,
                    NEW.updated_at
                );
            END;

    ');
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_insert;');
    }
};
