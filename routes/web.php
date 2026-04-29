<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/videos', function () {
    return view('pages.videos');
})->name('videos');

Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation');
Route::post('/recommendation/submit', [RecommendationController::class, 'submit'])->name('recommendation.submit');

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    Route::get('/admin/submissions', [AdminController::class, 'submissions'])->name('admin.submissions');
    Route::get('/admin/submissions/{submissionId}', [AdminController::class, 'submissionDetail'])->name('admin.submission.detail');
    // major
    Route::get('/admin/majors', [AdminController::class, 'majors'])->name('admin.majors');
    Route::get('/admin/majors/create', [AdminController::class, 'createMajor'])->name('admin.majors.create');
    Route::post('/admin/majors', [AdminController::class, 'storeMajor'])->name('admin.majors.store');
    Route::get('/admin/majors/{id}/edit', [AdminController::class, 'editMajor'])->name('admin.majors.edit');
    Route::put('/admin/majors/{id}', [AdminController::class, 'updateMajor'])->name('admin.majors.update');
    Route::delete('/admin/majors/{id}', [AdminController::class, 'deleteMajor'])->name('admin.majors.destroy');

    // Questions
    Route::get('/admin/questions', [AdminController::class, 'questionsManager'])->name('admin.questions.manager');
    Route::get('/admin/questions/create', [AdminController::class, 'createQuestion'])->name('admin.questions.create');
    Route::post('/admin/questions', [AdminController::class, 'storeQuestion'])->name('admin.questions.store');
    Route::get('/admin/questions/{id}/edit', [AdminController::class, 'editQuestion'])->name('admin.questions.edit');
    Route::put('/admin/questions/{id}', [AdminController::class, 'updateQuestion'])->name('admin.questions.update');
    Route::delete('/admin/questions/{id}', [AdminController::class, 'deleteQuestion'])->name('admin.questions.destroy');
    
    // Question Options
    Route::get('/admin/questions/{questionId}/options/create', [AdminController::class, 'createQuestionOption'])->name('admin.question-options.create');
    Route::post('/admin/question-options', [AdminController::class, 'storeQuestionOption'])->name('admin.question-options.store');
    Route::get('/admin/question-options/{id}/edit', [AdminController::class, 'editQuestionOption'])->name('admin.question-options.edit');
    Route::put('/admin/question-options/{id}', [AdminController::class, 'updateQuestionOption'])->name('admin.question-options.update');
    Route::delete('/admin/question-options/{id}', [AdminController::class, 'deleteQuestionOption'])->name('admin.question-options.destroy');

    
});

