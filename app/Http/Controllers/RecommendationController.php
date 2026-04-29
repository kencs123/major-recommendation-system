<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\StudentAnswer;
use App\Models\StudentMajor;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecommendationController extends Controller
{
   public function index()
    {
        
        $questions = Question::orderBy('idx')->get();
        
        return view('pages.recommendation', compact('questions'));
        
    }

    public function submit(Request $request)
    {
        DB::enableQueryLog();
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'answer' => 'required|array',
            'answer.*' => 'required|exists:question_options,id'
        ]);

        $studentName = $validated['student_name'];
        $answers = $validated['answer'];
        $submissionId = Str::uuid();

        // Save all student answers to database (only store the options)
        foreach ($answers as $questionId => $optionId) {
            StudentAnswer::create([
                'submission_id' => $submissionId,
                'student_name' => $studentName,
                'question_option_id' => $optionId,
            ]);
        }

        // Count votes for each major
        $majorScores = [];
        
        foreach ($answers as $questionId => $optionId) {
            $questionOption = QuestionOption::find($optionId);
            $majorId = $questionOption->major_id;
            
            if (!isset($majorScores[$majorId])) {
                $majorScores[$majorId] = [
                    'major' => Major::find($majorId),
                    'score' => 0
                ];
            }
            
            $majorScores[$majorId]['score']++;
        }

        // Find the highest score
        $maxScore = max(array_column($majorScores, 'score'));

        // Get all majors with the highest score
        $recommendedMajors = array_filter($majorScores, function ($item) use ($maxScore) {
            return $item['score'] == $maxScore;
        });

        // Save to StudentMajor table for each recommended major
        foreach ($recommendedMajors as $majorId => $data) {
            StudentMajor::create([
                'submission_id' => $submissionId,
                'student_name' => $studentName,
                'major_id' => $majorId,
            ]);
        }
        // dd(DB::getQueryLog());

        return view('pages.recommendation-result', [
            'submissionId' => $submissionId,
            'studentName' => $studentName,
            'recommendedMajors' => $recommendedMajors,
        ]);
    }
}
