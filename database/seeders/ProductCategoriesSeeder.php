<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert([
            [
                'product_category_uuid' => Str::uuid(),
                'product_category_name' => 'Papan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_category_uuid' => Str::uuid(),
                'product_category_name' => 'Perlengkapan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
