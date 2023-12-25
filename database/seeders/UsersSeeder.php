<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_uuid' => Str::uuid(),
                'user_name' => 'Muklisin',
                'user_username' => 'muklisin',
                'user_phonenumber' => '081228254409',
                'user_email' => 'muklismuklisin@gmail.com',
                'user_password' => bcrypt('muklis12345'),
                'user_isadmin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_uuid' => Str::uuid(),
                'user_name' => 'Puji Widyaningsih',
                'user_username' => 'pujiwidya',
                'user_phonenumber' => '081548452935',
                'user_email' => 'pujiwidya54530@gmail.com',
                'user_password' => bcrypt('puji12345'),
                'user_isadmin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_uuid' => 'cbba2a7c5-c330-41cb-b120-f596zx543d2',
                'user_name' => 'Dewi Lestari',
                'user_username' => 'dewilestari',
                'user_phonenumber' => '085866848017',
                'user_email' => 'dwlstr3004@gmail.com',
                'user_password' => bcrypt('dewi12345'),
                'user_isadmin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_uuid' => 'bcc2a7c5-c330-41cb-b120-f59617b43d01',
                'user_name' => 'Budi Santoso',
                'user_username' => 'budisantoso',
                'user_phonenumber' => '088765432103',
                'user_email' => 'budisantoso@gmail.com',
                'user_password' => bcrypt('budi12345'),
                'user_isadmin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    ]);
    }
}
