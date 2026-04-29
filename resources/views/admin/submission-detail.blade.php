
@extends('layouts.admin')

@section('title', 'Submission Details')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.submissions') }}" class="btn btn-outline-secondary">
            <i class="bi bi-chevron-left"></i> Back to Submissions
        </a>
    </div>
</div>

<!-- Student Info -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-person-circle"></i> Student Information
                </h5>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Student Name</p>
                        <h6 class="fw-bold">{{ $studentName }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Submission ID</p>
                        <code class="text-primary">{{ $submissionId }}</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recommended Majors -->
<div class="row mb-4">
    <div class="col-12">
        <h5 class="mb-3">
            <i class="bi bi-star"></i> Recommended Majors
        </h5>
        <div class="row">
            @foreach($studentMajors as $major)
                <div class="col-md-6 mb-3">
                    <div class="card border-left border-4 border-primary">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">{{ $major->major->name }}</h6>
                            <p class="card-text text-muted small">{{ $major->major->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Student Answers -->
<div class="row">
    <div class="col-12">
        <h5 class="mb-3">
            <i class="bi bi-card-checklist"></i> Student Answers
        </h5>
        <div class="table-container">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Selected Option</th>
                        <th>Linked Major</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentAnswers as $answer)
                        <tr>
                            <td>
                                <strong>{{ $answer->questionOption->question->question }}</strong>
                            </td>
                            <td>
                                {{ $answer->questionOption->option_text }}
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $answer->questionOption->major->name }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection