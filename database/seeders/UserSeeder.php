<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Usuario - Admin',
            'email' => 'admin@google.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);
    }
}
