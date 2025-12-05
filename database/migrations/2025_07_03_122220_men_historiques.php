<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. إنشاء جدول men_historiques
        Schema::create('men_historiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('men_id');
            $table->unsignedBigInteger('code_article_mens');
            $table->string('imager');
            $table->string('title');
            $table->string('content');
            $table->integer('price');
            $table->string('size');
            $table->integer('stock');
            $table->string('action');
            $table->timestamp('action_date')->useCurrent();
        });

        // 2. إنشاء التريغرات (Triggers)
        DB::unprepared('
            CREATE TRIGGER after_insert_men
            AFTER INSERT ON mens
            FOR EACH ROW
            BEGIN
                INSERT INTO men_historiques (men_id,code_article_mens, imager, title, content, price, size, stock, action)
                VALUES (NEW.id,NEW.code_article_mens, NEW.imager, NEW.title, NEW.content, NEW.price, NEW.size, NEW.stock, "insert");
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_update_men
            AFTER UPDATE ON mens
            FOR EACH ROW
            BEGIN
                INSERT INTO men_historiques (men_id,code_article_mens, imager, title, content, price, size, stock, action)
                VALUES (NEW.id,NEW.code_article_mens, NEW.imager, NEW.title, NEW.content, NEW.price, NEW.size, NEW.stock, "update");
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_delete_men
            AFTER DELETE ON mens
            FOR EACH ROW
            BEGIN
                INSERT INTO men_historiques (men_id,code_article_mens, imager, title, content, price, size, stock, action)
                VALUES (OLD.id,OLD.code_article_mens, OLD.imager, OLD.title, OLD.content, OLD.price, OLD.size, OLD.stock, "delete");
            END
        ');
    }

    public function down(): void
    {
        // حذف الـ triggers أولاً
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_men');
        DB::unprepared('DROP TRIGGER IF EXISTS after_update_men');
        DB::unprepared('DROP TRIGGER IF EXISTS after_delete_men');

        // ثم حذف جدول historique
        Schema::dropIfExists('men_historiques');
    }
};
