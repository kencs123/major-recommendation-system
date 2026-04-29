<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Major;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Question 1
        $q1 = Question::create([
            'question' => 'In my free time, I like to:',
            'idx' => 1
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'major_id' => Major::where('name', 'Game Developer')->first()->id,
            'option_text' => 'Play and analyze video games',
            'idx' => 1
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'major_id' => Major::where('name', 'Full Stack Development')->first()->id,
            'option_text' => 'Build websites and web applications',
            'idx' => 2
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'major_id' => Major::where('name', 'Cyber Security')->first()->id,
            'option_text' => 'Research security vulnerabilities',
            'idx' => 3
        ]);

        QuestionOption::create([
            'question_id' => $q1->id,
            'major_id' => Major::where('name', 'Artificial Intelligence')->first()->id,
            'option_text' => 'Experiment with AI and automation',
            'idx' => 4
        ]);

        // Question 2
        $q2 = Question::create([
            'question' => 'What interests you the most about technology?',
            'idx' => 2
        ]);

        QuestionOption::create([
            'question_id' => $q2->id,
            'major_id' => Major::where('name', 'Artificial Intelligence')->first()->id,
            'option_text' => 'How machines can think and learn',
            'idx' => 1
        ]);

        QuestionOption::create([
            'question_id' => $q2->id,
            'major_id' => Major::where('name', 'Cyber Security')->first()->id,
            'option_text' => 'Protecting systems from attacks',
            'idx' => 2
        ]);

        QuestionOption::create([
            'question_id' => $q2->id,
            'major_id' => Major::where('name', 'Full Stack Development')->first()->id,
            'option_text' => 'Creating user-friendly applications',
            'idx' => 3
        ]);

        QuestionOption::create([
            'question_id' => $q2->id,
            'major_id' => Major::where('name', 'Game Developer')->first()->id,
            'option_text' => 'Creating interactive experiences',
            'idx' => 4
        ]);

        // Question 3
        $q3 = Question::create([
            'question' => 'When facing a problem, I prefer to:',
            'idx' => 3
        ]);

        QuestionOption::create([
            'question_id' => $q3->id,
            'major_id' => Major::where('name', 'Cyber Security')->first()->id,
            'option_text' => 'Analyze and find potential threats',
            'idx' => 1
        ]);

        QuestionOption::create([
            'question_id' => $q3->id,
            'major_id' => Major::where('name', 'Artificial Intelligence')->first()->id,
            'option_text' => 'Use data and algorithms to solve it',
            'idx' => 2
        ]);

        QuestionOption::create([
            'question_id' => $q3->id,
            'major_id' => Major::where('name', 'Full Stack Development')->first()->id,
            'option_text' => 'Code a solution from scratch',
            'idx' => 3
        ]);

        QuestionOption::create([
            'question_id' => $q3->id,
            'major_id' => Major::where('name', 'Game Developer')->first()->id,
            'option_text' => 'Think creatively about the approach',
            'idx' => 4
        ]);

        // Question 4
        $q4 = Question::create([
            'question' => 'Which work environment appeals to you most?',
            'idx' => 4
        ]);

        QuestionOption::create([
            'question_id' => $q4->id,
            'major_id' => Major::where('name', 'Full Stack Development')->first()->id,
            'option_text' => 'Collaborative team building products',
            'idx' => 1
        ]);

        QuestionOption::create([
            'question_id' => $q4->id,
            'major_id' => Major::where('name', 'Game Developer')->first()->id,
            'option_text' => 'Creative studio environment',
            'idx' => 2
        ]);

        QuestionOption::create([
            'question_id' => $q4->id,
            'major_id' => Major::where('name', 'Artificial Intelligence')->first()->id,
            'option_text' => 'Research and experimentation lab',
            'idx' => 3
        ]);

        QuestionOption::create([
            'question_id' => $q4->id,
            'major_id' => Major::where('name', 'Cyber Security')->first()->id,
            'option_text' => 'Security operations center',
            'idx' => 4
        ]);

        // Question 5
        $q5 = Question::create([
            'question' => 'What kind of projects excite you?',
            'idx' => 5
        ]);

        QuestionOption::create([
            'question_id' => $q5->id,
            'major_id' => Major::where('name', 'Game Developer')->first()->id,
            'option_text' => 'Creating immersive gaming experiences',
            'idx' => 1
        ]);

        QuestionOption::create([
            'question_id' => $q5->id,
            'major_id' => Major::where('name', 'Full Stack Development')->first()->id,
            'option_text' => 'Building scalable web platforms',
            'idx' => 2
        ]);

        QuestionOption::create([
            'question_id' => $q5->id,
            'major_id' => Major::where('name', 'Cyber Security')->first()->id,
            'option_text' => 'Securing critical infrastructure',
            'idx' => 3
        ]);

        QuestionOption::create([
            'question_id' => $q5->id,
            'major_id' => Major::where('name', 'Artificial Intelligence')->first()->id,
            'option_text' => 'Building AI models and solutions',
            'idx' => 4
        ]);
    }
}
