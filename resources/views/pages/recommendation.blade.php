@extends('layouts.app')

@section('title', 'Major Recommendation Quiz')

@section('content')
<div class="quiz-wrapper">

    <div class="quiz-header">
        <p class="quiz-eyebrow">Find your path</p>
        <h1 class="quiz-title">Major Recommendation Quiz</h1>
        <p class="quiz-subtitle">Answer honestly — there are no wrong answers.</p>
    </div>

     {{-- Session / validation errors --}}
    @if($errors->any())
    <div class="quiz-alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        {{ $errors->first() }}
    </div>
    @endif

    {{-- Progress --}}
    <div class="quiz-progress">
        <div class="quiz-progress-meta">
            <span>Page {{ $questions->currentPage() }} of {{ $questions->lastPage() }}</span>
            <span>{{ $questions->firstItem() }}–{{ $questions->lastItem() }} of {{ $totalQuestions }} questions</span>
        </div>
        <div class="quiz-progress-track">
            <div class="quiz-progress-fill"
                style="width: {{ ($questions->currentPage() / $questions->lastPage()) * 100 }}%">
            </div>
        </div>
    </div>

    <form action="{{ route('recommendation') }}" method="POST" id="quizForm" novalidate>
        @csrf

        {{-- Name field (first page only) --}}
        @if($questions->onFirstPage())
        <div class="quiz-card name-card">
            <label class="quiz-label" for="studentName">
                <i class="bi bi-person-fill me-2"></i>What's your name?
            </label>
            <input type="text" class="quiz-input" id="studentName" name="student_name" placeholder="e.g. Alex Johnson"
                value="{{ old('student_name', $studentName) }}" required autocomplete="given-name">
        </div>
        @else
        <input type="hidden" name="student_name" value="{{ $studentName }}">
        @endif

        {{-- Questions --}}
        @foreach($questions as $index => $question)
        <div class="quiz-card question-card" style="animation-delay: {{ $index * 0.08 }}s">
            <div class="question-meta">
                <span class="question-badge">{{ $questions->firstItem() + $index }}</span>
            </div>
            <p class="question-text">{{ $question->question }}</p>

            <div class="options-list">
                @foreach($question->questionOptions()->orderBy('idx')->get() as $option)
                @php
                $isChecked = isset($savedAnswers[$question->id])
                ? $savedAnswers[$question->id] == $option->id
                : old("answer.{$question->id}") == $option->id;
                @endphp
                <div class="option-row">
                    <input type="radio" class="option-input" id="q{{ $question->id }}_o{{ $option->id }}"
                        name="answer[{{ $question->id }}]" value="{{ $option->id }}" @checked($isChecked) required>
                    <label class="option-label" for="q{{ $question->id }}_o{{ $option->id }}">
                        <span class="option-dot"></span>
                        <span class="option-text">{{ $option->option_text }}</span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        {{-- Navigation --}}
        <div class="quiz-nav">
            @if($questions->currentPage() > 1)
            <button type="submit" name="_page" value="{{ $questions->currentPage() - 1 }}"
                class="btn-nav btn-nav--ghost">
                <i class="bi bi-arrow-left me-2"></i>Back
            </button>
            @else
            <div></div>
            @endif

            @if($questions->hasMorePages())
            <button type="submit" name="_page" value="{{ $questions->currentPage() + 1 }}"
                class="btn-nav btn-nav--primary" id="nextBtn">
                Continue <i class="bi bi-arrow-right ms-2"></i>
            </button>
            @else
            <button type="submit" name="_action" value="submit" formaction="{{ route('recommendation.submit') }}"
                class="btn-nav btn-nav--success">
                <i class="bi bi-check-lg me-2"></i>See My Results
            </button>
            @endif
        </div>

    </form>
</div>



<script>
  document.getElementById('quizForm').addEventListener('submit', function (e) {
    const btn = e.submitter;

    // Let Back through immediately — no validation
    if (btn && btn.name === '_page' && parseInt(btn.value) < parseInt('{{ $questions->currentPage() }}')) {
        return true;
    }

    const allNames = [...new Set([...document.querySelectorAll('.option-input')].map(r => r.name))];
    const unanswered = allNames.filter(name => {
        return !document.querySelector(`input[name="${name}"]:checked`);
    });

    if (unanswered.length) {
        e.preventDefault();
        const first = document.querySelector(`input[name="${unanswered[0]}"]`);
        const card = first?.closest('.quiz-card');
        if (card) {
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            card.style.borderColor = '#f87171';
            card.style.boxShadow = '0 0 0 3px #fee2e2';
            setTimeout(() => {
                card.style.borderColor = '';
                card.style.boxShadow = '';
            }, 2000);
        }
    }
});
</script>
@endsection