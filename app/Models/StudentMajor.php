<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMajor extends Model
{
    use HasFactory;
    protected $fillable = [
        'submission_id',
        'student_name',
        'major_id',
    ];
   
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
    public function answers()
    {
        return $this->hasMany(StudentAnswer::class, 'submission_id', 'submission_id');
    }
}
