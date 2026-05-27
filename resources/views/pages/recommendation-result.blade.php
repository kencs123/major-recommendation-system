@extends('layouts.app')

@section('title', 'Your Recommendation')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2">
            <i class="bi bi-sparkles text-warning"></i> Your Recommended Major
        </h1>
        <p class="text-muted lead">Based on your quiz responses, here's the perfect fit for you!</p>
    </div>

    @if(count($recommendedMajors) == 1)
        <!-- Single Major Result -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <!-- Icon based on major -->
                        @php
                            $majorName = $recommendedMajors[array_key_first($recommendedMajors)]['major']->name;
                            $majorKey = strtolower(str_replace(' ', '', $majorName));
                            
                            $icons = [
                                'enterpriseinformationsystems' => 'bi-building',
                                'artificialintelligence' => 'bi-robot',
                                'fullstackdevelopment' => 'bi-layers',
                                'cybersecurity' => 'bi-shield-lock',
                                'gamedevelopment' => 'bi-joystick',
                            ];
                            $icon = $icons[$majorKey] ?? 'bi-check-circle';
                        @endphp

                        <div class="mb-4">
                            <i class="bi {{ $icon }}" style="font-size: 4rem; color: #0d6efd;"></i>
                        </div>

                        <h2 class="fw-bold mb-3">{{ $recommendedMajors[array_key_first($recommendedMajors)]['major']->name }}</h2>

                        <div class="alert alert-success" role="alert">
                            <p class="mb-0">
                                <i class="bi bi-check-circle-fill"></i> 
                                Perfect Match! This major aligns perfectly with your interests and strengths.
                            </p>
                        </div>

                        <div class="card bg-light border-0 mt-4">
                            <div class="card-body">
                                <p class="text-muted mb-0">
                                    Your quiz results show a strong preference for this field. We recommend exploring the videos and learning more about this exciting career path!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Multiple Majors Result -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="alert alert-info" role="alert">
                            <h5 class="mb-2">
                                <i class="bi bi-info-circle"></i> Equal Interest Detected
                            </h5>
                            <p class="mb-0">You have equal interest in multiple majors. Explore them all to find your best fit!</p>
                        </div>

                        <div class="row g-3 mt-4">
                            @foreach($recommendedMajors as $item)
                                @php
                                    $name = $item['major']->name;
                                    $key = strtolower(str_replace(' ', '', $name));
                                    $icons = [
                                        'enterpriseinformationsystems' => 'bi-building',
                                        'artificialintelligence' => 'bi-robot',
                                        'fullstackdevelopment' => 'bi-layers',
                                        'cybersecurity' => 'bi-shield-lock',
                                        'gamedevelopment' => 'bi-joystick',
                                    ];
                                    $icon = $icons[$key] ?? 'bi-check-circle';
                                @endphp

                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                                        <div class="mb-3">
                                            <i class="bi {{ $icon }}" style="font-size: 2.5rem; color: #0d6efd;"></i>
                                        </div>
                                        <h5 class="fw-bold">{{ $name }}</h5>
                                        <p class="text-muted small">Recommended for you</p>
                                        <span class="badge bg-primary">Match</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex gap-3 flex-wrap justify-content-center">
                <a href="{{ route('videos') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-play-circle"></i> Watch Videos
                </a>
                <a href="{{ route('recommendation') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-arrow-clockwise"></i> Retake Quiz
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-house-door"></i> Back Home
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="card bg-light border-0">
                <div class="card-body text-center">
                    <p class="text-muted mb-0">
                        <i class="bi bi-lightbulb"></i> 
                        Next step: Explore the recommended major's videos to learn more about the field, career opportunities, and what to expect!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease !important;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
    }

    .btn {
        transition: all 0.3s ease !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3) !important;
    }
</style>
@endsection