<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'code' => 'A00001',
            'password' => Hash::make('123456'),
            'name' => 'Admin 1',
            'email' => env('MAIL_FROM_ADDRESS', 'admin@mail.com'),
            'phone' => '09123456789',
            'role' => 4,
            'gender' => 1,
            'address' => 'Yangon',
        ]);
    }
}
