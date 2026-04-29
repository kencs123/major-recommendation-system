@extends('layouts.app')

@section('title', 'Your Recommendation')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Your Recommended Major(s)</h2>
    
    @if(count($recommendedMajors) == 1)
        <div class="alert alert-success">
            <h3>{{ $recommendedMajors[array_key_first($recommendedMajors)]['major']->name }}</h3>

        </div>
    @else
        <div class="alert alert-info">
            <p>You have equal interest in these majors:</p>
            @foreach($recommendedMajors as $item)
                <h4>{{ $item['major']->name }}</h4>
            @endforeach
        </div>
    @endif
    
    <a href="{{ route('recommendation') }}" class="btn btn-primary">Retake Quiz</a>
    <a href="{{ route('home') }}" class="btn btn-secondary">Back Home</a>
</div>
@endsection