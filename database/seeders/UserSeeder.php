<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'Sakib Faturrahman',
            'email' => 'sakibfaturrahman@gmail.com',
            'password' => Hash::make('123'),
            'alamat' => 'jawa',
            'role_id' => 1, // Role Admin
        ]);

        DB::table('users')->insert([
            'name' => 'Faisal Farhan Nugraha',
            'email' => 'faisal@gmail.com',
            'password' => Hash::make('123'),
            'alamat' => 'jawa',
            'role_id' => 2, // Role Kasir
        ]);
    }
}
