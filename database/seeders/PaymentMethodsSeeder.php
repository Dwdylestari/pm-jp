<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('paymentmethods')->insert([
            [
                'paymentmethod_uuid' => Str::uuid(),
                'paymentmethod_user_uuid' => 'cbba2a7c5-c330-41cb-b120-f596zx543d2',
                'paymentmethod_bank_uuid' => '1f94c154-fc77-48ab-bf47-6823c5ae13bc',
                'paymentmethod_accountnumber' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paymentmethod_uuid' => Str::uuid(),
                'paymentmethod_user_uuid' => 'cbba2a7c5-c330-41cb-b120-f596zx543d2',
                'paymentmethod_bank_uuid' => '9faab6e3-cfbc-46c0-b8d9-9c972a268571',
                'paymentmethod_accountnumber' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paymentmethod_uuid' => Str::uuid(),
                'paymentmethod_user_uuid' => 'cbba2a7c5-c330-41cb-b120-f596zx543d2',
                'paymentmethod_bank_uuid' => 'bd13cb03-8773-4236-a5b2-6ae7febe17d7',
                'paymentmethod_accountnumber' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paymentmethod_uuid' => Str::uuid(),
                'paymentmethod_user_uuid' => 'bcc2a7c5-c330-41cb-b120-f59617b43d01',
                'paymentmethod_bank_uuid' => 'bd13cb03-8773-4236-a5b2-6ae7febe17d7',
                'paymentmethod_accountnumber' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paymentmethod_uuid' => Str::uuid(),
                'paymentmethod_user_uuid' => 'bcc2a7c5-c330-41cb-b120-f59617b43d01',
                'paymentmethod_bank_uuid' => '9faab6e3-cfbc-46c0-b8d9-9c972a268571',
                'paymentmethod_accountnumber' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
