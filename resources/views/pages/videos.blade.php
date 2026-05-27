@extends('layouts.app')

@section('title', 'Videos')

@section('content')
<div class="container-fluid py-4">
    <!-- Major Tabss -->
    <div class="mb-5">
        {{-- <div class="d-flex justify-content-center mb-4">
            <h2 class="text-center fw-bold">Select a Major</h2>
        </div> --}}

        <ul class="nav nav-tabs justify-content-center border-0" role="tablist" style="gap: 10px; flex-wrap: wrap;">
            @foreach($majors as $key => $major)
                <li class="nav-item" role="presentation">
                    <a 
                        class="nav-link px-4 py-2 rounded-3 fw-semibold transition-all @if(request('major') === $key || (request('major') === null && $loop->first)) active bg-primary text-white @else bg-light text-dark @endif" 
                        href="{{ route('videos') }}?major={{ $key }}"
                        role="tab"
                        style="border: none; text-decoration: none; cursor: pointer; transition: all 0.3s ease;"
                    >
                        @if($key === 'eis')
                            <i class="bi bi-building"></i>
                        @elseif($key === 'ai')
                            <i class="bi bi-robot"></i>
                        @elseif($key === 'fullstack')
                            <i class="bi bi-layers"></i>
                        @elseif($key === 'cybersecurity')
                            <i class="bi bi-shield-lock"></i>
                        @elseif($key === 'gamedev')
                            <i class="bi bi-joystick"></i>
                        @endif
                        {{ $major['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @php
        $currentMajorKey = request('major') ?? array_key_first($majors);
        $currentMajor = $majors[$currentMajorKey] ?? reset($majors);
        $currentVideoIndex = 0;
    @endphp

    <div class="row justify-content-center">
        <!-- Video Player-->
        <div class="col-lg-10 col-xl-9">
            <div class="card shadow-lg border-0">
                <div class="card-body p-0">
                    <video id="myPlayer" class="video-js vjs-default-skin" controls preload="auto" width="100%">
                        <source id="videoSource" src="{{ $currentMajor['videos'][0]['url'] }}" type="video/mp4">
                        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p>
                    </video>
                </div>
            </div>

            <!-- Video Info -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 id="videoTitle" class="fw-bold mb-2">{{ $currentMajor['videos'][0]['title'] }}</h4>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-primary">
                                    <i class="bi bi-play-circle"></i>
                                    Video <span id="videoNumber">1</span> of <span id="videoTotal">{{ count($currentMajor['videos']) }}</span>
                                </span>
                                <span class="badge bg-secondary">
                                    <i class="bi bi-folder"></i> {{ $currentMajor['name'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons ai only-->
                    @if(count($currentMajor['videos']) > 1)
                        <hr class="my-3">
                        <div class="d-flex gap-2">
                            <button id="prevBtn" class="btn btn-outline-secondary" style="display: none;">
                                <i class="bi bi-chevron-left"></i> Previous Video
                            </button>
                            <button id="nextBtn" class="btn btn-primary">
                                <i class="bi bi-chevron-right"></i> Next Video
                            </button>
                        </div>
                    @endif

                    <hr class="my-3">

                    <div class="d-flex gap-2">
                        <a href="{{ route('recommendation') }}" class="btn btn-primary w-100">
                            <i class="bi bi-compass"></i> Take the Quiz
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-link {
        transition: all 0.3s ease !important;
    }

    .nav-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }

    .nav-link.active {
        box-shadow: 0 6px 16px rgba(13, 110, 253, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const player = videojs('myPlayer', {
            responsive: true,
            fluid: true,
            controls: true,
            autoplay: false,
            preload: 'auto',
            playbackRates: [0.5, 1, 1.25, 1.5, 2]
        });

        const videosData = @json($currentMajor['videos']);
        let currentIndex = 0;

        const videoSource = document.getElementById('videoSource');
        const videoTitle = document.getElementById('videoTitle');
        const videoNumber = document.getElementById('videoNumber');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        function updateVideo(index) {
            if (index < 0 || index >= videosData.length) return;

            currentIndex = index;
            const video = videosData[index];

            videoSource.src = video.url;
            videoTitle.textContent = video.title;
            videoNumber.textContent = index + 1;

            player.src({ src: video.url, type: 'video/mp4' });
            player.play();

            // Update button visibility
            prevBtn.style.display = currentIndex > 0 ? 'block' : 'none';
            nextBtn.style.display = currentIndex < videosData.length - 1 ? 'block' : 'none';
            nextBtn.textContent = currentIndex < videosData.length - 1 ? '<i class="bi bi-chevron-right"></i> Next Video' : '<i class="bi bi-check-circle"></i> End of Series';
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (currentIndex < videosData.length - 1) {
                    updateVideo(currentIndex + 1);
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    updateVideo(currentIndex - 1);
                }
            });
        }

        // Initialize button states
        if (videosData.length > 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'block';
        }
    });
</script>
@endsection