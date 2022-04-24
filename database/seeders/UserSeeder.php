<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Alana',
            'last_name' => 'Petshop',
            'email' => 'mail@mail.com',
            'password' => '$2y$10$TJtSwuoo/M5RFppI6QkTx.ljfMUdR5kZPHP7./z5ZecwVN7O6Nf0i',
            'cellphone' => '1111111111',
            'address' => 'Bello Horizonte',
            'user_status' => '1',
            'tipo_usuario_id' => '1'
        ]);
    }
}
