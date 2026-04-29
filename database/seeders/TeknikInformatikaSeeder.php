<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Question;
use Illuminate\Database\Seeder;

class TeknikInformatikaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $major = Major::create([
            'name' => 'Teknik Informatika',
            'description' => 'Learn about software',
            'idx' => 1
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari teknologi komputer dan perkembangan digital.',
            'idx' => 1
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya sering mencari informasi tentang teknologi baru.',
            'idx' => 2
        ]);

        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya merasa bidang informatika memiliki peluang karir yang menarik.',
            'idx' => 3
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya menikmati aktivitas yang berhubungan dengan komputer.',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari cara kerja sistem komputer.',
            'idx' => 5
        ]);
    }
}
