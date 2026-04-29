
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h4><i class="bi bi-mortarboard"></i> PETRA</h4>
            <small>Admin Panel</small>
        </div>

        <nav class="nav flex-column">
            <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link @if(request()->routeIs('admin.submissions*')) active @endif"
                href="{{ route('admin.submissions') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Submissions</span>
            </a>

            <!-- Management Section -->
            <hr class="bg-secondary my-2">

            <a class="nav-link @if(request()->routeIs('admin.majors*')) active @endif"
                href="{{ route('admin.majors') }}">
                <i class="bi bi-collection"></i>
                <span>Majors</span>
            </a>
            <a class="nav-link @if(request()->routeIs('admin.questions*')) active @endif"
                href="{{ route('admin.questions.manager') }}">
                <i class="bi bi-chat-left-text"></i>
                <span>Questions & Options</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-admin navbar-expand-lg">
            <div class="container-fluid">
                <span class="navbar-brand">
                    <i class="bi bi-bookmark-fill" style="color: var(--accent-color); margin-right: 8px;"></i>
                    @yield('title')
                </span>
                <div class="ms-auto user-info">
                    <span>
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::guard('admin')->user()->name }}
                    </span>
                    {{-- <div class="user-avatar">
                        {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                    </div> --}}
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Logout">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div style="padding: 0 30px 30px 30px;">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>