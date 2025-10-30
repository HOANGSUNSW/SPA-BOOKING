@extends('layouts.admin')

@section('title', 'Login - Anh Thơ Spa')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <img src="{{ asset('imgs/logo.jpg') }}" alt="Logo" width="60">
            <h4 class="mt-3 text-primary fw-bold">Welcome back</h4>
            <p class="text-muted mb-0">Login to manage your bookings</p>
        </div>

@if (session('error'))
    <div class="alert alert-danger text-center mt-3">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="text-center text-muted">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
