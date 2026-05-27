<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid px-4">
        <!-- Logo & Brand -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Petra Logo">
        </a>
        
        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('videos*')) active @endif" href="{{ route('videos') }}">
                        <i class="bi bi-play-circle"></i> Videos
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('recommendation')) active @endif" href="{{ route('recommendation') }}">
                        <i class="bi bi-compass"></i> Start Quiz
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>