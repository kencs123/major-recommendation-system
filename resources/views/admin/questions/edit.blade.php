@extends('layouts.admin')

@section('title', 'Edit Question')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Edit Question</h5>

                <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="question" class="form-label fw-bold">Question</label>
                        <textarea name="question" id="question" class="form-control @error('question') is-invalid @enderror" rows="3" required>{{ $question->question }}</textarea>
                        @error('question')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="idx" class="form-label fw-bold">Order (idx)</label>
                        <input type="number" name="idx" id="idx" class="form-control @error('idx') is-invalid @enderror" value="{{ $question->idx }}" required>
                        @error('idx')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Question
                        </button>
                        <a href="{{ route('admin.questions.manager') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection