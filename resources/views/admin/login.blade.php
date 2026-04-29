
@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">🎓 Admin Panel</h2>
                        <p class="text-muted">Welcome Back</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Login Failed!</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('admin.login.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email Address</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email"
                                placeholder="admin@petra.com"
                                required
                            >
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password"
                                placeholder="Enter your password"
                                required
                            >
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center text-muted small">
                        Demo Credentials:<br>
                        Email: <code>admin@petra.com</code><br>
                        Password: <code>password123</code>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection