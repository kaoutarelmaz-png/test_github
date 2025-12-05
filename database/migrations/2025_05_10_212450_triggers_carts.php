<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Trigger بعد الإدخال
        DB::unprepared('
            CREATE TRIGGER after_cart_insert
            AFTER INSERT ON carts
            FOR EACH ROW
            BEGIN
                INSERT INTO histroquecarts (
                    cart_id, action, user_id, user_name, imager, title, content,size, price, quantite, Total, created_at
                ) VALUES (
                    NEW.id, "INSERT", NEW.user_id, NEW.user_name, NEW.imager, NEW.title, NEW.content, NEW.size, NEW.price, NEW.quantite, NEW.Total, NOW()
                );
            END;
        ');

        // Trigger بعد التحديث
        DB::unprepared('
            CREATE TRIGGER after_cart_update
            AFTER UPDATE ON carts
            FOR EACH ROW
            BEGIN
                INSERT INTO histroquecarts (
                    cart_id, action, user_id, user_name, imager, title, content,size, price, quantite, Total, created_at
                ) VALUES (
                    NEW.id, "UPDATE", NEW.user_id, NEW.user_name, NEW.imager, NEW.title, NEW.content,NEW.size, NEW.price, NEW.quantite, NEW.Total, NOW()
                );
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_cart_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS after_cart_update;');
    }
};
