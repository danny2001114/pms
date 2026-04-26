<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectType;
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
            'password' => Hash::make('123456'),
            'name' => 'Super Admin',
            'role' => 4,
        ]);

        ProjectType::insert([
            ["label" => "Ecommerce"],
            ["label" => "Game"],
            ["label" => "System"]
        ]);
    }
}
