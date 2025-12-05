<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_historiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('code_article_shops');
            $table->string('imager');
            $table->string('title');
            $table->string('content');
            $table->string('price');
            $table->string('size');
            $table->integer('stock');
            $table->string('action');
            $table->timestamp('action_date')->useCurrent();
        });

        DB::unprepared('
            CREATE TRIGGER after_insert_shop
            AFTER INSERT ON shops
            FOR EACH ROW
            BEGIN
                INSERT INTO shop_historiques (shop_id,code_article_shops, imager, title, content, price, size, stock, action)
                VALUES (NEW.id,NEW.code_article_shops, NEW.imager, NEW.title, NEW.content, NEW.price, NEW.size, NEW.stock, "insert");
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_update_shop
            AFTER UPDATE ON shops
            FOR EACH ROW
            BEGIN
                INSERT INTO shop_historiques (shop_id,code_article_shops, imager, title, content, price, size, stock, action)
                VALUES (NEW.id,NEW.code_article_shops, NEW.imager, NEW.title, NEW.content, NEW.price, NEW.size, NEW.stock, "update");
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_delete_shop
            AFTER DELETE ON shops
            FOR EACH ROW
            BEGIN
                INSERT INTO shop_historiques (shop_id,code_article_shops, imager, title, content, price, size, stock, action)
                VALUES (OLD.id,OLD.code_article_shops, OLD.imager, OLD.title, OLD.content, OLD.price, OLD.size, OLD.stock, "delete");
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_shop');
        DB::unprepared('DROP TRIGGER IF EXISTS after_update_shop');
        DB::unprepared('DROP TRIGGER IF EXISTS after_delete_shop');

        Schema::dropIfExists('shop_historiques');
    }
};

