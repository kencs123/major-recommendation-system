<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::create([
            'name' => 'Artificial Intelligence',
            'description' => 'Learn about AI, machine learning, and automation',
            'idx' => 2
        ]);
        Major::create([
            'name' => 'Cyber Security',
            'description' => 'Learn about IT Security and hacking',
            'idx' => 4
        ]);
        Major::create([
            'name' => 'Full Stack Development',
            'description' => 'Learn about making software fullstack',
            'idx' => 5
        ]);
        Major::create([
            'name' => 'Game Developer',
            'description' => 'Learn about making games',
            'idx' => 3
        ]);
        Major::create([
            'name' => 'Teknik Informatika',
            'description' => 'Learn about software',
            'idx' => 1
        ]);
        Major::create([
            'name' => 'Enterprise Information System',
            'description' => 'Learn about EIS',
            'idx' => 1
        ]);
    }
}
