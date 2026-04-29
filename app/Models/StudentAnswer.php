<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'submission_id',
        'student_name',
        'question_option_id',
    ];

    public function questionOption()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }

    public function question()
    {
        return $this->questionOption()->first()->question();
    }
}
