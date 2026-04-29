<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\StudentAnswer;
use App\Models\StudentMajor;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest:admin')->only(['loginForm', 'login']);
    //     $this->middleware('auth:admin')->only(['dashboard', 'submissions', 'submissionDetail', 'logout']);
    // }
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function dashboard()
    {
        $totalSubmissions = StudentMajor::distinct('submission_id')->count('submission_id');
        $totalStudents = StudentMajor::distinct('student_name')->count('student_name');
        $totalMajors = Major::count();
        $totalQuestions = Question::count();
        
        // Get latest submissions
        $submissions = StudentMajor::select('submission_id', 'student_name', 'created_at')
            ->groupBy('submission_id', 'student_name', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Map submissions with all recommended majors
        $latestSubmissions = $submissions->map(function($submission) {
            $majors = StudentMajor::where('submission_id', $submission->submission_id)
                ->with('major')
                ->get();
            
            // Format majors as comma-separated string in controller
            $submission->major_names = $majors->pluck('major.name')->join(', ');
            $submission->major_count = $majors->count();
            
            return $submission;
        });

        return view('admin.dashboard', compact('totalSubmissions', 'totalStudents', 'totalMajors', 'totalQuestions', 'latestSubmissions'));
    }

    public function submissions()
    {
        $submissions = StudentMajor::select('submission_id', 'student_name', 'created_at')
        ->groupBy('submission_id', 'student_name', 'created_at')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        $submissions->getCollection()->transform(function($submission) {
            $majors = StudentMajor::where('submission_id', $submission->submission_id)
                ->with('major')
                ->get();
            
            $answers = StudentAnswer::where('submission_id', $submission->submission_id)
                ->count();
            
            $submission->major_names = $majors->pluck('major.name')->join(', ');
            $submission->major_count = $majors->count();
            $submission->answer_count = $answers;
            // dd($submission);
            
            return $submission;
        });

        return view('admin.submissions', compact('submissions'));

    }
    public function submissionDetail($submissionId)
    {
        $studentMajors = StudentMajor::where('submission_id', $submissionId)->get();
        $studentAnswers = StudentAnswer::where('submission_id', $submissionId)->get();
        $studentName = StudentMajor::where('submission_id', $submissionId)->first()->student_name;

        return view('admin.submission-detail', compact('studentMajors', 'studentAnswers', 'studentName', 'submissionId'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function majors()
    {
        $majors = Major::orderBy('idx')->paginate(10);
        return view('admin.majors.index', compact('majors'));
    }

    public function createMajor()
    {
        return view('admin.majors.create');
    }

    public function storeMajor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:majors,name',
            'description' => 'nullable|string',
            'idx' => 'required|integer|unique:majors,idx',
        ]);

        Major::create($validated);
        return redirect()->route('admin.majors')->with('success', 'Major created successfully!');
    }

    public function editMajor($id)
    {
        $major = Major::findOrFail($id);
        return view('admin.majors.edit', compact('major'));
    }

    public function updateMajor(Request $request, $id)
    {
        $major = Major::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|unique:majors,name,' . $id,
            'description' => 'nullable|string',
            'idx' => 'required|integer|unique:majors,idx,' . $id,
        ]);

        $major->update($validated);
        return redirect()->route('admin.majors')->with('success', 'Major updated successfully!');
    }

    public function deleteMajor($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();
        return redirect()->route('admin.majors')->with('success', 'Major deleted successfully!');
    }

     public function questionsManager()
    {
        $questions = Question::with('questionOptions')->orderBy('idx')->paginate(10);
        return view('admin.questions.manager', compact('questions'));
    }

    public function createQuestion()
    {
        return view('admin.questions.create');
    }

    public function storeQuestion(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'idx' => 'required|integer|unique:questions,idx',
        ]);

        Question::create($validated);
        return redirect()->route('admin.questions.manager')->with('success', 'Question created successfully!');
    }

    public function editQuestion($id)
    {
        $question = Question::with('questionOptions')->findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        
        $validated = $request->validate([
            'question' => 'required|string',
            'idx' => 'required|integer|unique:questions,idx,' . $id,
        ]);

        $question->update($validated);
        return redirect()->route('admin.questions.manager')->with('success', 'Question updated successfully!');
    }

    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('admin.questions.manager')->with('success', 'Question deleted successfully!');
    }

    // Question Options
    public function createQuestionOption($questionId)
    {
        $question = Question::findOrFail($questionId);
        $majors = Major::orderBy('idx')->get();
        return view('admin.question-options.create', compact('question', 'majors'));
    }

    public function storeQuestionOption(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'major_id' => 'required|exists:majors,id',
            'option_text' => 'required|string',
            'idx' => 'required|integer',
        ]);
        

        QuestionOption::create($validated);
        return redirect()->route('admin.questions.manager')->with('success', 'Option added successfully!');
    }

    public function editQuestionOption($id)
    {
        $option = QuestionOption::findOrFail($id);
        $question = Question::findOrFail($option->question_id);
        $majors = Major::orderBy('idx')->get();
        return view('admin.question-options.edit', compact('option', 'majors', 'question'));
    }

    public function updateQuestionOption(Request $request, $id)
    {
        $option = QuestionOption::findOrFail($id);
        
        $validated = $request->validate([
            'major_id' => 'required|exists:majors,id',
            'option_text' => 'required|string',
            'idx' => 'required|integer',
        ]);

        $option->update($validated);
        return redirect()->route('admin.questions.manager')->with('success', 'Option updated successfully!');
    }

    public function deleteQuestionOption($id)
    {
        $option = QuestionOption::findOrFail($id);
        $option->delete();
        return redirect()->route('admin.questions.manager')->with('success', 'Option deleted successfully!');
    }
}
