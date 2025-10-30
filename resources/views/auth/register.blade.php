@extends('layouts.admin')

@section('title', 'Register - Anh Thơ Spa')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 420px; width: 100%;">
        <div class="text-center mb-4">
            <img src="{{ asset('imgs/logo.jpg') }}" alt="Logo" width="60">
            <h4 class="mt-3 text-primary fw-bold">Anh Thơ Spa</h4>
            <p class="text-muted mb-0">Create your account to start booking</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Your phone number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Your address">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="At least 6 characters" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>

            <div class="text-center text-muted">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a>
            </div>
        </form>
    </div>
</div>
@endsection
