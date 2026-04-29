@extends('layouts.admin')

@section('title', 'Questions Manager')

@section('content')


<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Question
        </a>
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
        @forelse($questions as $question)
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <!-- Question Header -->
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="card-title mb-1">
                                <span class="badge bg-secondary me-2">Q{{ $question->idx }}</span>
                                {{ $question->question }}
                            </h5>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this question?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Options Section -->
                    <div class="options-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">
                                <i class="bi bi-list-check"></i> Options ({{ $question->questionOptions->count() }})
                            </h6>
                            <a 
                                href="{{ route('admin.question-options.create', $question->id) }}" 
                                class="btn btn-sm btn-success"
                            >
                                <i class="bi bi-plus"></i> Add Option
                            </a>
                        </div>

                        @if($question->questionOptions->count() > 0)
                            @foreach($question->questionOptions->sortBy('idx') as $option)
                                <div class="option-item">
                                    <div class="option-text">
                                        <small class="text-muted">{{ $option->major->name }}</small><br>
                                        <strong>{{ $option->option_text }}</strong>
                                    </div>
                                    <div class="option-actions">
                                        <a 
                                            href="{{ route('admin.question-options.edit', $option->id) }}" 
                                            class="btn btn-sm btn-outline-secondary" 
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form 
                                            action="{{ route('admin.question-options.destroy', $option->id) }}" 
                                            method="POST" 
                                            style="display: inline;"
                                            onsubmit="return confirm('Delete this option?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Delete"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted text-center py-3">No options yet. Add one!</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No questions yet. Create one to get started!</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $questions->links() }}
</div>
@endsection