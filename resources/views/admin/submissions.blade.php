@extends('layouts.admin')

@section('title', 'Submissions')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-file-earmark-text"></i> All Submissions
            </h5>
            <span class="badge bg-primary">{{ $submissions->total() }} Total</span>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        @if($submissions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <i class="bi bi-hash"></i> No
                            </th>
                            <th>
                                <i class="bi bi-person"></i> Student Name
                            </th>
                            <th>
                                <i class="bi bi-collection"></i> Recommended Major(s)
                            </th>
                            <th class="text-center">
                                <i class="bi bi-chat-left-text"></i> Answers
                            </th>
                            <th>
                                <i class="bi bi-calendar"></i> Submission Date
                            </th>
                            <th class="text-end">
                                <i class="bi bi-gear"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $key => $submission)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $submissions->firstItem() + $key }}</span>
                                </td>
                                <td>
                                    <strong>{{ $submission->student_name }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach(explode(', ', $submission->major_names) as $major)
                                            <span class="badge bg-info text-dark">{{ $major }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">{{ $submission->answer_count }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="bi bi-clock"></i>
                                        {{ $submission->created_at->format('M d, Y') }}
                                        <br>
                                        <small>{{ $submission->created_at->format('H:i') }}</small>
                                    </small>
                                </td>
                                <td class="text-end">
                                    <a 
                                        href="{{ route('admin.submission.detail', $submission->submission_id) }}" 
                                        class="btn btn-sm btn-outline-primary btn-sm-custom"
                                        title="View Details"
                                    >
                                        <i class="bi bi-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.5;"></i>
                                    <p class="mt-3 mb-0">No submissions yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $submissions->links() }}
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No submissions yet. Students will see their results here once they complete the quiz.</p>
                </div>
            </div>
        @endif
    </div>
</div>


@endsection