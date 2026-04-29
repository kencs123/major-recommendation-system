<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Question;
use Illuminate\Database\Seeder;

class GameDeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $major = Major::create([
            'name' => 'Game Developer',
            'description' => 'Learn about making games',
            'idx' => 3
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik belajar membuat program komputer.',
            'idx' => 1
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mencoba membuat game sederhana.',
            'idx' => 2
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari bahasa pemrograman seperti Python atau Java untuk membuat game.',
            'idx' => 3
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya senang memecahkan masalah menggunakan logika pemrograman.',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya ingin mengikuti quiz coding atau kompetisi pemrograman.',
            'idx' => 5
        ]);
    }
}
