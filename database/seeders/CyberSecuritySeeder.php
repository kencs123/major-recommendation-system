<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Question;
use Illuminate\Database\Seeder;

class CyberSecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $major = Major::create([
            'name' => 'Cyber Security',
            'description' => 'Learn about IT Security and hacking',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari cara melindungi sistem komputer dari hacker.',
            'idx' => 1
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mengetahui cara kerja keamanan jaringan.',
            'idx' => 2
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari hacking.',
            'idx' => 3
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari cara melindungi data dan privasi.',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik bekerja di bidang keamanan cyber.',
            'idx' => 5
        ]);
    }
}
