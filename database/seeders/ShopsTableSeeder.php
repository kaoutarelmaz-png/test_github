<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            DB::table('shops')->insert([
                'code_article_shops' => 2000 + $i,
                'imager' => '1763482332.png',
                'title' => 'Product '.$i,
                'content' => 'Description for product '.$i,
                'price' => rand(10, 100),
                'size' => 'M',
                'stock' => rand(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
