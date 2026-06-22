@extends('layouts.app')

@section('title', 'Videos')

@section('content')
<div class="container-fluid py-4">

    {{-- Major Tabs --}}
    <div class="mb-5">
        <ul class="nav nav-tabs justify-content-center border-0" role="tablist" style="gap: 10px; flex-wrap: wrap;">
            @foreach($majors as $key => $major)
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link px-4 py-2 rounded-3 fw-semibold
                            @if(request('major') === $key || (request('major') === null && $loop->first))
                                active bg-primary text-white
                            @else
                                bg-light text-dark
                            @endif"
                        href="{{ route('videos') }}?major={{ $key }}"
                        role="tab"
                        style="border: none; text-decoration: none; cursor: pointer;"
                    >
                        @if($key === 'eis')         <i class="bi bi-building"></i>
                        @elseif($key === 'ai')       <i class="bi bi-robot"></i>
                        @elseif($key === 'fullstack') <i class="bi bi-layers"></i>
                        @elseif($key === 'cybersecurity') <i class="bi bi-shield-lock"></i>
                        @elseif($key === 'gamedev')  <i class="bi bi-joystick"></i>
                        @endif
                        {{ $major['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @php
        $currentMajorKey = request('major') ?? array_key_first($majors);
        $currentMajor    = $majors[$currentMajorKey] ?? reset($majors);
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            {{-- Player Card --}}
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-body p-0" style="background: #000;">
                    <div id="playerContainer" style="width: 100%; position: relative;">

                        {{-- Native HTML5 video — no Video.js --}}
                        <video
                            id="myPlayer"
                            controls
                            preload="metadata"
                            style="width: 100%; display: none; background: #000; max-height: 540px;"
                            controlsList="nodownload"
                        >
                            Your browser does not support HTML5 video.
                        </video>

                        <img
                            id="imageContainer"
                            src=""
                            alt="Content image"
                            style="display: none; width: 100%; height: auto; max-height: 480px; object-fit: contain;"
                        >
                    </div>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 id="itemTitle" class="fw-bold mb-2"></h4>
                        <div class="d-flex gap-3 flex-wrap">
                            <span class="badge bg-primary">
                                <i id="itemIcon" class="bi bi-play-circle"></i>
                                <span id="itemNumber"></span>
                                of
                                <span id="itemTotal">{{ count($currentMajor['videos']) }}</span>
                            </span>
                            <span class="badge bg-secondary">
                                <i class="bi bi-folder"></i> {{ $currentMajor['name'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Nav buttons (only when there is more than one item) --}}
                    @if(count($currentMajor['videos']) > 1)
                        <hr class="my-3">
                        <div class="d-flex gap-2 flex-wrap" id="navButtonsWrapper">
                            @foreach($currentMajor['videos'] as $index => $item)
                                <button
                                    type="button"
                                    class="nav-item-btn btn btn-outline-primary"
                                    data-index="{{ $index }}"
                                >
                                    @if($item['type'] === 'image')
                                        <i class="bi bi-image"></i> Image
                                    @else
                                        <i class="bi bi-play-circle"></i> Video {{ $index + 1 }}
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @endif

                    <hr class="my-3">

                    <a href="{{ route('recommendation') }}" class="btn btn-primary w-100">
                        <i class="bi bi-compass"></i> Take the Quiz
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .nav-link { transition: all 0.3s ease !important; }
    .nav-link:hover { transform: translateY(-3px); box-shadow: 0 4px 12px rgba(13,110,253,.2); }
    .nav-link.active { box-shadow: 0 6px 16px rgba(13,110,253,.3); }

    #myPlayer:focus { outline: none; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const itemsData   = @json($currentMajor['videos']);

    const myPlayer       = document.getElementById('myPlayer');
    const imageContainer = document.getElementById('imageContainer');
    const itemTitle      = document.getElementById('itemTitle');
    const itemNumber     = document.getElementById('itemNumber');
    const itemIcon       = document.getElementById('itemIcon');
    const navButtons     = document.querySelectorAll('.nav-item-btn');

    // ─── Core update function ──────────────────────────────────────────────
    function updateItem(index) {
        if (index < 0 || index >= itemsData.length) return;

        const item = itemsData[index];

        // Update title badge
        itemTitle.textContent = item.title;

        // Highlight the active nav button
        navButtons.forEach(btn => {
            btn.classList.toggle('btn-primary',         parseInt(btn.dataset.index) === index);
            btn.classList.toggle('active',              parseInt(btn.dataset.index) === index);
            btn.classList.toggle('btn-outline-primary', parseInt(btn.dataset.index) !== index);
        });

        if (item.type === 'image') {
            // ── Show image ───────────────────────────────────────────────
            myPlayer.pause();
            myPlayer.style.display = 'none';

            imageContainer.src           = item.url;
            imageContainer.style.display = 'block';

            itemIcon.className   = 'bi bi-image';
            itemNumber.textContent = 'Image';

        } else {
            // ── Show video ───────────────────────────────────────────────
            imageContainer.style.display = 'none';

            // IMPORTANT: set src BEFORE making element visible,
            // then call load() so the browser picks up the new source.
            myPlayer.pause();
            myPlayer.src             = item.url;
            myPlayer.style.display   = 'block';
            myPlayer.load();

            // Attempt autoplay; browsers may block it — user can press Play
            myPlayer.play().catch(() => {});

            itemIcon.className     = 'bi bi-play-circle';
            itemNumber.textContent = 'Video ' + (index + 1);
        }
    }

    // ─── Button listeners ──────────────────────────────────────────────────
    navButtons.forEach(btn => {
        btn.addEventListener('click', () => updateItem(parseInt(btn.dataset.index)));
    });

    // ─── Always show first item on load ───────────────────────────────────
    // This is what was missing — both containers stay display:none without this call.
    updateItem(0);
});
</script>
@endsection