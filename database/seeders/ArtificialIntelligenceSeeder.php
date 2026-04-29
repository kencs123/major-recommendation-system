<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ArtificialIntelligenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $major = Major::create([
            'name' => 'Artificial Intelligence',
            'description' => 'Learn about AI, machine learning, and automation',
            'idx' => 2
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari bagaimana komputer dapat berpikir seperti manusia.',
            'idx' => 1
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya ingin mengetahui cara kerja teknologi seperti ChatGPT atau AI lainya.',
            'idx' => 2
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik membuat program yang dapat mengenali gambar atau suara.',
            'idx' => 3
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik mempelajari Machine Learning.',
            'idx' => 4
        ]);
        Question::create([
            'major_id' => $major->id,
            'question' => 'Saya tertarik di bidang pengembangan AI di masa depan.',
            'idx' => 5
        ]);


    }
}
