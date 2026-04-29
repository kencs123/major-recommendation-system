<?php

namespace Database\Seeders;

use App\Models\Admin;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@petra.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
