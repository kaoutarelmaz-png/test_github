<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('woman_historiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('woman_id');
            $table->unsignedBigInteger('code_article_womans');
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
            CREATE TRIGGER after_insert_woman
            AFTER INSERT ON womans
            FOR EACH ROW
            BEGIN
                INSERT INTO woman_historiques (woman_id,code_article_womans, imager, title, content, price, size, stock, action)
                VALUES (NEW.id,NEW.code_article_womans, NEW.imager, NEW.title, NEW.content, NEW.price, NEW.size, NEW.stock, "insert");
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_update_woman
            AFTER UPDATE ON womans
            FOR EACH ROW
            BEGIN
                INSERT INTO woman_historiques (woman_id,code_article_womans, imager, title, content, price, size, stock, action)
                VALUES (NEW.id,NEW.code_article_womans, NEW.imager, NEW.title, NEW.content, NEW.price, NEW.size, NEW.stock, "update");
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_delete_woman
            AFTER DELETE ON womans
            FOR EACH ROW
            BEGIN
                INSERT INTO woman_historiques (woman_id,code_article_womans, imager, title, content, price, size, stock, action)
                VALUES (OLD.id,OLD.code_article_womans, OLD.imager, OLD.title, OLD.content, OLD.price, OLD.size, OLD.stock, "delete");
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_woman');
        DB::unprepared('DROP TRIGGER IF EXISTS after_update_woman');
        DB::unprepared('DROP TRIGGER IF EXISTS after_delete_woman');

        Schema::dropIfExists('woman_historiques');
    }
};

