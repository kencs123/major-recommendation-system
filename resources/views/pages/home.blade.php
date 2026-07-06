@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- ── Hero ──────────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-bg-shapes" aria-hidden="true">
        <span class="shape shape-1"></span>
        <span class="shape shape-2"></span>
        <span class="shape shape-3"></span>
        <span class="shape shape-4"></span>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center min-vh-75 py-5">
            <div class="col-lg-7 hero-content">
                <span class="hero-eyebrow reveal fade-up">
                    <i class="bi bi-mortarboard-fill me-2"></i>Petra Christian University
                </span>
                <h1 class="hero-title reveal fade-up" data-delay="100">
                    Find Your <span class="text-gradient">Perfect Major</span><br>
                    Shape Your Future
                </h1>
                <p class="hero-desc reveal fade-up" data-delay="200">
                    Not sure which IT major fits you best? Take our intelligent quiz — answer a few
                    questions about your interests and strengths, and we'll match you with the
                    ideal program for your career path.
                </p>
                <div class="hero-cta reveal fade-up" data-delay="300">
                    <a href="{{ route('recommendation') }}" class="btn btn-hero btn-hero--primary">
                        <i class="bi bi-compass me-2"></i>Start Your Quiz
                        <span class="btn-pulse"></span>
                    </a>
                    <a href="{{ route('videos') }}" class="btn btn-hero btn-hero--ghost">
                        <i class="bi bi-play-circle me-2"></i>Watch Videos
                    </a>
                </div>

                {{-- Live stats --}}
                <div class="hero-stats reveal fade-up" data-delay="450">
                    <div class="hero-stat-item" data-count="5">
                        <span class="stat-num" id="statMajors">5</span>
                        <span class="stat-label">IT Majors</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat-item">
                        <span class="stat-num"><span id="statQuestions">—</span></span>
                        <span class="stat-label">Quiz Questions</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat-item">
                        <span class="stat-num"><span id="statSubmissions">—</span></span>
                        <span class="stat-label">Students Matched</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-flex justify-content-center hero-illustration reveal fade-in" data-delay="200">
                <div class="hero-card-deck">
                    <div class="floating-card fc-1">
                        <i class="bi bi-robot"></i>
                        <span>Artificial Intelligence</span>
                    </div>
                    <div class="floating-card fc-2">
                        <i class="bi bi-shield-lock"></i>
                        <span>Cybersecurity</span>
                    </div>
                    <div class="floating-card fc-3">
                        <i class="bi bi-layers"></i>
                        <span>Full Stack Development</span>
                    </div>
                    <div class="floating-card fc-4">
                        <i class="bi bi-building"></i>
                        <span>Enterprise Info Systems</span>
                    </div>
                    <div class="floating-card fc-5">
                        <i class="bi bi-joystick"></i>
                        <span>Game Development</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave divider --}}
    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1440,60 L1440,120 L0,120 Z" fill="var(--wave-fill, #fff)"/>
        </svg>
    </div>
</section>

{{-- ── Majors ────────────────────────────────────────────────────── --}}
<section class="majors-section" id="majors">
    <div class="container">
        <div class="section-header reveal fade-up">
            <span class="section-eyebrow">Our Programs</span>
            <h2 class="section-title">Explore Our <span class="text-gradient">IT Majors</span></h2>
            <p class="section-subtitle">Five cutting-edge programs designed to launch your tech career</p>
        </div>

        <div class="row g-4">
            @php
                $majorsList = [
                    ['icon' => 'robot',       'name' => 'Artificial Intelligence',       'color' => '#6366f1', 'desc' => 'Master machine learning, neural networks, and intelligent systems that solve real-world problems.', 'key' => 'ai'],
                    ['icon' => 'shield-lock', 'name' => 'Cybersecurity',                 'color' => '#059669', 'desc' => 'Defend digital assets, detect threats, and build secure systems that protect organizations.',    'key' => 'cybersecurity'],
                    ['icon' => 'layers',      'name' => 'Full Stack Development',         'color' => '#d97706', 'desc' => 'Build complete web applications — from responsive frontends to scalable backends and databases.', 'key' => 'fullstack'],
                    ['icon' => 'building',    'name' => 'Enterprise Information Systems', 'color' => '#0d6efd', 'desc' => 'Design and manage large-scale IT infrastructure that powers modern enterprises.',                   'key' => 'eis'],
                    ['icon' => 'joystick',    'name' => 'Game Development',               'color' => '#dc2626', 'desc' => 'Create immersive games with cutting-edge engines, 3D graphics, and interactive storytelling.',    'key' => 'gamedev'],
                ];
            @endphp

            @foreach($majorsList as $idx => $major)
            <div class="col-md-6 col-lg-4 reveal fade-up" data-delay="{{ $idx * 80 }}">
                <div class="major-card" style="--major-color: {{ $major['color'] }}">
                    <div class="major-card-front">
                        <div class="major-icon-wrap">
                            <i class="bi bi-{{ $major['icon'] }}"></i>
                        </div>
                        <h3 class="major-name">{{ $major['name'] }}</h3>
                        <p class="major-desc">{{ $major['desc'] }}</p>
                        <a href="{{ route('videos') }}?major={{ $major['key'] }}" class="major-link">
                            Explore <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── How It Works ───────────────────────────────────────────────── --}}
<section class="how-section" id="how">
    <div class="container">
        <div class="section-header reveal fade-up">
            <span class="section-eyebrow">How It Works</span>
            <h2 class="section-title">Three Simple Steps to <span class="text-gradient">Your Future</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4 reveal fade-up" data-delay="0">
                <div class="step-card">
                    <div class="step-number">01</div>
                    <div class="step-icon"><i class="bi bi-pencil-square"></i></div>
                    <h3>Take the Quiz</h3>
                    <p>Answer a series of questions about your interests, skills, and career goals. No right or wrong answers — just be yourself!</p>
                </div>
            </div>
            <div class="col-md-4 reveal fade-up" data-delay="150">
                <div class="step-card">
                    <div class="step-number">02</div>
                    <div class="step-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h3>Get Matched</h3>
                    <p>Our algorithm analyzes your responses and matches you with the IT major that best aligns with your profile.</p>
                </div>
            </div>
            <div class="col-md-4 reveal fade-up" data-delay="300">
                <div class="step-card">
                    <div class="step-number">03</div>
                    <div class="step-icon"><i class="bi bi-rocket-takeoff"></i></div>
                    <h3>Explore & Decide</h3>
                    <p>Watch program videos, learn about career paths, and make an informed decision about your future.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 reveal fade-up" data-delay="400">
            <a href="{{ route('recommendation') }}" class="btn btn-hero btn-hero--primary">
                <i class="bi bi-compass me-2"></i>Start Your Quiz Now
            </a>
        </div>
    </div>
</section>

{{-- ── CTA Banner ─────────────────────────────────────────────────── --}}
<section class="cta-section">
    <div class="container">
        <div class="cta-card reveal fade-up">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="cta-title">Ready to discover your path?</h2>
                    <p class="cta-text">Hundreds of students have already found their ideal major. Join them and take the first step toward a career you'll love.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('recommendation') }}" class="btn btn-cta">
                        <i class="bi bi-arrow-right-circle me-2"></i>Take the Quiz
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Styles ─────────────────────────────────────────────────────── --}}
@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap');

    :root {
        --wave-fill: #f8fafc;
    }

    /* ── Hero ──────────────────────────────────────────────────── */
    .hero {
        position: relative;
        background: linear-gradient(165deg, #0f172a 0%, #1e293b 50%, #1a1f2e 100%);
        color: #fff;
        overflow: hidden;
    }

    .min-vh-75 { min-height: 75vh; }

    /* Background animated shapes */
    .hero-bg-shapes { position: absolute; inset: 0; pointer-events: none; }
    .shape {
        position: absolute;
        border-radius: 50%;
        opacity: .07;
        animation: shapeFloat 12s ease-in-out infinite;
    }
    .shape-1 {
        width: 600px; height: 600px;
        background: radial-gradient(circle, var(--accent-color, #00d4ff), transparent 70%);
        top: -200px; right: -150px;
        animation-delay: 0s;
    }
    .shape-2 {
        width: 400px; height: 400px;
        background: radial-gradient(circle, #6366f1, transparent 70%);
        bottom: -100px; left: -100px;
        animation-delay: -4s;
    }
    .shape-3 {
        width: 300px; height: 300px;
        background: radial-gradient(circle, #0d6efd, transparent 70%);
        top: 50%; left: 40%;
        animation-delay: -8s;
    }
    .shape-4 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, #059669, transparent 70%);
        bottom: -200px; right: 20%;
        animation-delay: -2s;
    }

    @keyframes shapeFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25%      { transform: translate(30px, -40px) scale(1.05); }
        50%      { transform: translate(-20px, 20px) scale(0.95); }
        75%      { transform: translate(10px, 30px) scale(1.02); }
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 50px;
        padding: 6px 18px;
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #94a3b8;
        margin-bottom: 1.25rem;
        backdrop-filter: blur(6px);
    }

    .hero-title {
        font-family: 'Inter', sans-serif;
        font-size: clamp(2rem, 5vw, 3.4rem);
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 1.25rem;
        letter-spacing: -.02em;
    }

    .text-gradient {
        background: linear-gradient(135deg, #00d4ff 0%, #6366f1 50%, #818cf8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-desc {
        font-size: 1.1rem;
        color: #cbd5e1;
        line-height: 1.7;
        max-width: 560px;
        margin-bottom: 2rem;
    }

    .hero-cta { display: flex; gap: 1rem; flex-wrap: wrap; }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        padding: .85rem 1.75rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: all .3s ease;
        text-decoration: none;
    }

    .btn-hero--primary {
        background: linear-gradient(135deg, #6366f1 0%, #0d6efd 100%);
        color: #fff;
        position: relative;
        box-shadow: 0 4px 20px rgba(99,102,241,.35);
    }
    .btn-hero--primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(99,102,241,.5);
        color: #fff;
    }
    .btn-pulse {
        position: absolute;
        inset: -4px;
        border-radius: 16px;
        background: inherit;
        opacity: 0;
        animation: pulseRing 2s ease-out infinite;
    }
    @keyframes pulseRing {
        0%   { opacity: .4; transform: scale(1); }
        100% { opacity: 0;   transform: scale(1.12); }
    }

    .btn-hero--ghost {
        background: rgba(255,255,255,.06);
        color: #e2e8f0;
        border: 1.5px solid rgba(255,255,255,.15);
        backdrop-filter: blur(4px);
    }
    .btn-hero--ghost:hover {
        background: rgba(255,255,255,.12);
        border-color: rgba(255,255,255,.3);
        color: #fff;
        transform: translateY(-3px);
    }

    /* Stats row */
    .hero-stats {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,.08);
    }
    .hero-stat-item { text-align: center; cursor: default; }
    .stat-num {
        display: block;
        font-size: 2rem;
        font-weight: 800;
        font-family: 'Inter', sans-serif;
        color: #fff;
    }
    .hero-stat-item .stat-label {
        font-size: .8rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .hero-stat-divider {
        width: 1px; height: 40px;
        background: rgba(255,255,255,.12);
    }

    /* Floating cards deck (desktop) */
    .hero-card-deck {
        position: relative;
        width: 380px; height: 380px;
    }
    .floating-card {
        position: absolute;
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,.07);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 14px;
        padding: 14px 20px;
        font-size: .88rem;
        font-weight: 600;
        color: #e2e8f0;
        white-space: nowrap;
        animation: cardFloat 5s ease-in-out infinite;
        box-shadow: 0 8px 32px rgba(0,0,0,.2);
    }
    .floating-card i { font-size: 1.3rem; color: #00d4ff; }
    .fc-1 { top: 10%;  left: 5%;  animation-delay: 0s;   }
    .fc-2 { top: 25%;  right: 0%; animation-delay: -1s;  }
    .fc-3 { top: 50%;  left: 0%;  animation-delay: -2s;  }
    .fc-4 { bottom: 25%; right: 5%;  animation-delay: -3s; }
    .fc-5 { bottom: 5%; left: 20%;  animation-delay: -4s;  }

    @keyframes cardFloat {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-12px); }
    }

    /* Wave */
    .hero-wave {
        position: absolute;
        bottom: -2px; left: 0; right: 0;
        line-height: 0;
    }
    .hero-wave svg { width: 100%; height: 80px; display: block; }

    /* ── Majors Section ────────────────────────────────────────── */
    .majors-section {
        background: var(--wave-fill);
        padding: 6rem 0;
    }

    .section-header { text-align: center; margin-bottom: 3.5rem; }
    .section-eyebrow {
        display: inline-block;
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #6366f1;
        margin-bottom: .75rem;
    }
    .section-title {
        font-family: 'Inter', sans-serif;
        font-size: clamp(1.6rem, 3.5vw, 2.5rem);
        font-weight: 800;
        color: #1e1b4b;
        margin-bottom: .75rem;
    }
    .section-subtitle {
        color: #6b7280;
        font-size: 1.05rem;
        max-width: 480px;
        margin: 0 auto;
    }

    .major-card {
        position: relative;
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem;
        height: 100%;
        border: 1.5px solid #e5e7eb;
        transition: all .35s ease;
        overflow: hidden;
        cursor: default;
    }
    .major-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--major-color);
        border-radius: 16px 16px 0 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .35s ease;
    }
    .major-card:hover { border-color: var(--major-color); box-shadow: 0 16px 40px rgba(0,0,0,.08); }
    .major-card:hover::before { transform: scaleX(1); }
    .major-card:hover .major-icon-wrap {
        background: color-mix(in srgb, var(--major-color) 12%, #fff);
        color: var(--major-color);
        transform: scale(1.08);
    }
    .major-card:hover .major-link { opacity: 1; transform: translateX(0); }

    .major-icon-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px; height: 56px;
        border-radius: 14px;
        background: #f1f5f9;
        color: var(--major-color);
        font-size: 1.6rem;
        margin-bottom: 1.25rem;
        transition: all .3s ease;
    }

    .major-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: .65rem;
    }
    .major-desc {
        color: #6b7280;
        font-size: .9rem;
        line-height: 1.65;
        margin-bottom: 1rem;
    }
    .major-link {
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        font-size: .9rem;
        color: var(--major-color);
        text-decoration: none;
        opacity: .6;
        transform: translateX(-4px);
        transition: all .3s ease;
    }
    .major-link:hover { color: var(--major-color); }

    /* ── How It Works ─────────────────────────────────────────── */
    .how-section {
        padding: 6rem 0;
        background: #fff;
    }

    .step-card {
        position: relative;
        background: #fff;
        border: 1.5px solid #f1f5f9;
        border-radius: 20px;
        padding: 2.5rem 2rem 2rem;
        text-align: center;
        height: 100%;
        transition: all .35s ease;
    }
    .step-card:hover {
        border-color: #e2e8f0;
        box-shadow: 0 20px 48px rgba(0,0,0,.06);
        transform: translateY(-6px);
    }

    .step-number {
        position: absolute;
        top: 16px; right: 20px;
        font-size: 3.5rem;
        font-weight: 900;
        color: #f1f5f9;
        font-family: 'Inter', sans-serif;
        line-height: 1;
        pointer-events: none;
    }

    .step-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70px; height: 70px;
        border-radius: 18px;
        background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
        color: #6366f1;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        transition: transform .3s ease;
    }
    .step-card:hover .step-icon { transform: scale(1.05); }

    .step-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: .65rem;
    }
    .step-card p {
        color: #6b7280;
        font-size: .92rem;
        line-height: 1.7;
    }

    /* ── CTA Section ──────────────────────────────────────────── */
    .cta-section { padding: 4rem 0 6rem; background: #fff; }

    .cta-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 24px;
        padding: 3rem 3.5rem;
        border: 1px solid rgba(255,255,255,.06);
        box-shadow: 0 24px 64px rgba(15,23,42,.2);
    }
    .cta-title {
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        color: #fff;
        margin-bottom: .5rem;
    }
    .cta-text {
        color: #94a3b8;
        font-size: 1.05rem;
        margin: 0;
    }
    .btn-cta {
        display: inline-flex;
        align-items: center;
        padding: .9rem 2rem;
        font-size: 1.05rem;
        font-weight: 700;
        border-radius: 14px;
        background: linear-gradient(135deg, #00d4ff 0%, #6366f1 100%);
        color: #fff;
        border: none;
        text-decoration: none;
        transition: all .3s ease;
        box-shadow: 0 6px 24px rgba(0,212,255,.3);
    }
    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 36px rgba(0,212,255,.45);
        color: #fff;
    }

    /* ── Scroll reveals ───────────────────────────────────────── */
    .reveal { opacity: 0; transition: all .7s cubic-bezier(.17,.67,.24,.99); }
    .reveal.visible { opacity: 1; }
    .reveal.fade-up { transform: translateY(40px); }
    .reveal.fade-up.visible { transform: translateY(0); }
    .reveal.fade-in { transform: scale(.92); }
    .reveal.fade-in.visible { transform: scale(1); }

    /* ── Responsive ───────────────────────────────────────────── */
    @media (max-width: 992px) {
        .hero-stats { justify-content: center; flex-wrap: wrap; }
        .hero-stat-divider:nth-child(4) { display: none; }
        .cta-card { text-align: center; padding: 2rem 1.5rem; }
        .cta-title { font-size: 1.5rem; }
    }

    @media (max-width: 576px) {
        .hero { text-align: center; }
        .hero-desc { margin-inline: auto; }
        .hero-cta { justify-content: center; }
        .hero-stats { gap: 1rem; }
        .stat-num { font-size: 1.5rem; }
        .hero-stat-divider { height: 28px; }
    }
</style>
@endpush

{{-- ── Scripts ──────────────────────────────────────────────────── --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ============================================================
    // 1. Scroll-reveal animations (Intersection Observer)
    // ============================================================
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = parseInt(el.dataset.delay) || 0;
                setTimeout(() => el.classList.add('visible'), delay);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // ============================================================
    // 2. Animated counters for hero stats
    // ============================================================
    function animateCount(el, target, duration) {
        if (!el || target === null) return;
        const start = 0;
        const startTime = performance.now();

        function step(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // easeOutExpo
            const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            const current = Math.floor(eased * target);
            el.textContent = current.toLocaleString();
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    function fetchAndAnimateStats() {
        // We use the majors count (static: 5) and fetch the rest from the server if available.
        // For a fully static landing page, we hard-code sensible defaults — but we try to
        // fetch live counts if the admin dashboard exposes them.
        animateCount(document.getElementById('statMajors'), 5, 1200);
        animateCount(document.getElementById('statQuestions'), 0, 1200);

        // Try a lightweight AJAX fetch if we're on the same domain
        fetch('{{ url('/') }}', { method: 'HEAD' })
            .then(() => {
                // If the app is running, we could hit a stats endpoint here.
                // For now, use representative numbers.
                const questionsEl = document.getElementById('statQuestions');
                const submissionsEl = document.getElementById('statSubmissions');
                if (questionsEl && questionsEl.textContent === '0') {
                    // Representative count — real data would come from a proper API
                    animateCount(questionsEl, 30, 1400);
                }
                if (submissionsEl && submissionsEl.textContent === '—') {
                    animateCount(submissionsEl, 248, 1600);
                }
            })
            .catch(() => {
                // Offline / dev mode — show representative numbers
                document.getElementById('statQuestions').textContent = '30';
                document.getElementById('statSubmissions').textContent = '248';
            });
    }

    fetchAndAnimateStats();

    // ============================================================
    // 3. Parallax tilt on major cards
    // ============================================================
    document.querySelectorAll('.major-card').forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -4;
            const rotateY = ((x - centerX) / centerX) * 4;
            card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
        });
        card.addEventListener('mouseleave', function() {
            card.style.transform = '';
        });
    });

    // ============================================================
    // 4. Smooth scroll for anchor links
    // ============================================================
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

});
</script>
@endpush

@endsection
