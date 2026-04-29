@extends('layouts.app')

@section('title', 'Recommendation Quiz')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-3">🎓 Major Recommendation Quiz</h1>
        <p class="lead text-muted">Discover your perfect major by answering a few simple questions!</p>
    </div>

    <form action="{{ route('recommendation.submit') }}" method="POST" id="recommendationForm">
        @csrf

        <!-- Student Name Input -->
        <div class="card mb-5 border-0 shadow-sm">
            <div class="card-body p-4">
                <label for="studentName" class="form-label fw-bold mb-3">
                    <i class="bi bi-person-circle"></i> What's your name?
                </label>
                <input 
                    type="text" 
                    class="form-control form-control-lg" 
                    id="studentName" 
                    name="student_name" 
                    placeholder="Enter your name..."
                    required
                >
            </div>
        </div>

        <!-- Questions Section -->
        <div class="mb-5">
            <div class="progress mb-4" style="height: 8px;">
                <div class="progress-bar bg-gradient" role="progressbar" id="progressBar" style="width: 0%"></div>
            </div>

            @foreach($questions as $index => $question)
                <div class="card mb-4 border-0 shadow-sm transition-all" style="animation: slideIn 0.5s ease;">
                    <div class="card-body p-4">
                        <!-- Question Number and Text -->
                        <div class="mb-4">
                            <span class="badge bg-primary rounded-pill me-2">Question {{ $index + 1 }} of {{ $questions->count() }}</span>
                            <h5 class="card-title fw-bold mt-3">
                                {{ $question->question}}
                            </h5>
                        </div>

                        <!-- Options -->
                        <div class="options-container">
                            @foreach($question->questionOptions()->orderBy('idx')->get() as $option)
                                <div class="option-item mb-3">
                                    <input 
                                        type="radio" 
                                        class="btn-check option-radio" 
                                        name="answer[{{ $question->id }}]" 
                                        id="q{{ $question->id }}opt{{ $option->id }}" 
                                        value="{{ $option->id }}" 
                                        required
                                        data-question="{{ $index + 1 }}"
                                    >
                                    <label class="btn btn-outline-primary w-100 text-start py-3 px-4 option-label" for="q{{ $question->id }}opt{{ $option->id }}">
                                        <div class="d-flex align-items-center">
                                            <div class="option-circle me-3">
                                                <i class="bi bi-circle option-icon"></i>
                                                <i class="bi bi-check-circle check-icon d-none"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0">{{ $option->option_text }}</p>
                                                {{-- <p class="mb-0">{{ $option->major_id }}</p> --}}
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2 mb-5">
            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                <i class="bi bi-arrow-right-circle"></i> See My Result
            </button>
        </div>
    </form>
</div>

<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .option-radio:checked + .option-label {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }

    .option-radio:checked + .option-label small {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .option-label {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .option-label:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }

    .option-circle {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f0f0f0;
        font-size: 18px;
    }

    .option-radio:checked + .option-label .option-circle {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .option-radio:checked + .option-label .option-icon {
        display: none;
    }

    .option-radio:checked + .option-label .check-icon {
        display: inline !important;
        color: white;
    }

    .check-icon {
        position: absolute;
        font-size: 20px;
    }
</style>

<script>
    document.getElementById('recommendationForm').addEventListener('change', function() {
        let totalQuestions = {{ $questions->count() }};
        let answeredQuestions = document.querySelectorAll('.option-radio:checked').length;
        let percentage = (answeredQuestions / totalQuestions) * 100;
        document.getElementById('progressBar').style.width = percentage + '%';
    });
</script>
@endsection