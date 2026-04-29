@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stat Cards -->
    <div class="col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon text-primary">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="stat-number">{{ $totalSubmissions }}</div>
            <div class="stat-label">Total Submissions</div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon text-success">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-number">{{ $totalStudents }}</div>
            <div class="stat-label">Total Students</div>
        </div>
    </div>

    <!-- Majors Stat -->
    <div class="col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon text-warning">
                <i class="bi bi-collection"></i>
            </div>
            <div class="stat-number">{{ $totalMajors }}</div>
            <div class="stat-label">Total Majors</div>
        </div>
    </div>

    <!-- Questions Stat -->
    <div class="col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon text-info">
                <i class="bi bi-chat-left-text"></i>
            </div>
            <div class="stat-number">{{ $totalQuestions }}</div>
            <div class="stat-label">Total Questions</div>
        </div>
    </div>
</div>

<!-- Latest Submissions -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clock-history"></i> Latest Submissions
                    </h5>
                    <a href="{{ route('admin.submissions') }}" class="btn btn-sm btn-outline-primary">
                        View All →
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($latestSubmissions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Recommended Major(s)</th>
                                    <th>Date</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestSubmissions as $submission)
                                    <tr>
                                        <td>
                                            <strong>{{ $submission->student_name }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                
                                                {{ $submission->major_names ?: 'N/A' }}
                                            </small>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $submission->created_at->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td class="text-end">
                                            <a 
                                                href="{{ route('admin.submission.detail', $submission->submission_id) }}" 
                                                class="btn btn-sm btn-outline-primary"
                                            >
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox" style="font-size: 2.5rem;"></i>
                        <p class="mt-3">No submissions yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats Summary -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-charge"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-auto">
                        <a href="{{ route('admin.submissions') }}" class="btn btn-primary">
                            <i class="bi bi-file-earmark-text"></i> Submissions
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.majors') }}" class="btn btn-warning">
                            <i class="bi bi-collection"></i> Majors
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.questions.manager') }}" class="btn btn-info">
                            <i class="bi bi-chat-left-text"></i> Questions
                        </a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection