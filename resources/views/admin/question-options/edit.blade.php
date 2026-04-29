@extends('layouts.admin')

@section('title', 'Edit Option')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Edit Option</h5>
                
                <h5 class="card-subtitle mb-3 text-muted">{{ $question->question }}</h5>

                <form action="{{ route('admin.question-options.update', $option->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Major</label>
                        <select name="major_id" class="form-select @error('major_id') is-invalid @enderror" required>
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}" @if($major->id == $option->major_id) selected @endif>{{ $major->name }}</option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Option Text</label>
                        <input type="text" name="option_text" class="form-control @error('option_text') is-invalid @enderror" value="{{ $option->option_text }}" required>
                        @error('option_text')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Order (idx)</label>
                        <input type="number" name="idx" class="form-control @error('idx') is-invalid @enderror" value="{{ $option->idx }}" required>
                        @error('idx')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Option
                        </button>
                        <a href="{{ route('admin.questions.manager') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection