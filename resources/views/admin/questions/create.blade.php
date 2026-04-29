@extends('layouts.admin')

@section('title', 'Create Question')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Create New Question</h5>

                <form action="{{ route('admin.questions.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="question" class="form-label fw-bold">Question</label>
                        <textarea name="question" id="question" class="form-control @error('question') is-invalid @enderror" rows="3" placeholder="e.g., In my free time, I like to:" required></textarea>
                        @error('question')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="idx" class="form-label fw-bold">Order (idx)</label>
                        <input type="number" name="idx" id="idx" class="form-control @error('idx') is-invalid @enderror" placeholder="1" required>
                        @error('idx')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Create Question
                        </button>
                        <a href="{{ route('admin.questions.manager') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection