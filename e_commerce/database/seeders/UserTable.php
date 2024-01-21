<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'status' => 1
            ],
            //vendor
            [
                'name' => 'Vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'vendor',
                'status' => 1
            ],
            //user
            [
                'name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'customer',
                'status' => 1
            ],
        ]);
    }
}
