<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'major_id',
        'option_text',
        'idx',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class, 'question_option_id');
    }
}