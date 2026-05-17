<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\StudentAnswer;
use App\Models\StudentMajor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecommendationController extends Controller
{
    private const PER_PAGE = 10;

   public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->filled('student_name')) {
                $request->session()->put('quiz.student_name', $request->input('student_name'));
            }

            if ($request->has('answer')) {
                $incoming = $request->input('answer', []);
                $saved    = $request->session()->get('quiz.answers', []);

                if (!is_array($saved) || array_is_list($saved)) {
                    $saved = [];
                }

                $request->session()->put('quiz.answers', $incoming + $saved);
            }
        }

        $page = (int) $request->input('_page', $request->query('page', 1));
        $questions = Question::orderBy('idx')->paginate(self::PER_PAGE, ['*'], 'page', $page);
        $totalQuestions = Question::count();
        $savedAnswers = $request->session()->get('quiz.answers', []);
        $studentName = $request->session()->get('quiz.student_name', '');

        return view('pages.recommendation', compact(
            'questions', 'totalQuestions', 'savedAnswers', 'studentName'
        ));
    }

    public function submit(Request $request)
{
    // Save the final page's answers into session first
    if ($request->has('answer')) {
        $incoming = $request->input('answer', []);
        $saved    = $request->session()->get('quiz.answers', []);

        if (!is_array($saved) || array_is_list($saved)) {
            $saved = [];
        }

        $request->session()->put('quiz.answers', $incoming + $saved);
    }

    // Read complete data from session
    $answers     = $request->session()->get('quiz.answers', []);
    $studentName = $request->session()->get('quiz.student_name', '');

    // session expired or incomplete (too make sure answers are existed)
    if (empty($answers) || empty($studentName)) {
        return redirect()->route('recommendation')
            ->withErrors(['error' => 'Your session expired. Please retake the quiz.']);
    }

    $submissionId = Str::uuid();
    // dd($answers, $studentName, $submissionId);
    
    foreach ($answers as $questionId => $optionId) {
        StudentAnswer::create([
            'submission_id'      => $submissionId,
            'student_name'       => $studentName,
            'question_option_id' => $optionId,
        ]);
    }

    // Tally scores per major (single query)
    $options     = QuestionOption::with('major')->whereIn('id', array_values($answers))->get();
    $majorScores = [];

    foreach ($options as $option) {
        $majorId = $option->major_id;

        if (!isset($majorScores[$majorId])) {
            $majorScores[$majorId] = ['major' => $option->major, 'score' => 0];
        }

        $majorScores[$majorId]['score']++;
    }

    $maxScore          = max(array_column($majorScores, 'score'));
    $recommendedMajors = array_filter($majorScores, fn($item) => $item['score'] === $maxScore);

    //insert recommended majors
    
    foreach ($recommendedMajors as $majorId => $data) {
        StudentMajor::create([
            'submission_id' => $submissionId,
            'student_name'  => $studentName,
            'major_id'      => $majorId,
        ]);
    }   

    // Clear quiz session
    $request->session()->forget(['quiz.answers', 'quiz.student_name']);

    return view('pages.recommendation-result', [
        'submissionId'      => $submissionId,
        'studentName'       => $studentName,
        'recommendedMajors' => $recommendedMajors,
    ]);
}
}