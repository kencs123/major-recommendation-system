<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Question;
use Illuminate\Database\Seeder;

class FullStackDeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $major = Major::create([
            'name' => 'Full Stack Development',
            'description' => 'Learn about making software fullstack',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik membuat website atau aplikasi.',
            'idx' => 1
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya ingin mempelajari cara membuat tampilan web (UI UX).',
            'idx' => 2
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari cara kerja server dan database.',
            'idx' => 3
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik membuat aplikasi yang digunakan banyak orang.',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari teknologi web modern.',
            'idx' => 5
        ]);
    }
}
