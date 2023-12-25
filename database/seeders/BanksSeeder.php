<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->insert([
            [
                'bank_uuid' => '1f94c154-fc77-48ab-bf47-6823c5ae13bc',
                'bank_name' => 'Bank Central Asia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_uuid' => '9faab6e3-cfbc-46c0-b8d9-9c972a268571',
                'bank_name' => 'Bank Mandiri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_uuid' => 'bd13cb03-8773-4236-a5b2-6ae7febe17d7',
                'bank_name' => 'Bank Negara Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bank_uuid' => 'f64000db-cbb3-4137-a5ba-96f0afcb0ffb',
                'bank_name' => 'Bank Republik Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
    ]);
    }
}
