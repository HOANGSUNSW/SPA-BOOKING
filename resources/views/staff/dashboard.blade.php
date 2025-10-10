@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>👩‍💼 Welcome, Staff!</h2>
    <p>Quản lý lịch hẹn và chăm sóc khách hàng.</p>
    <a href="{{ route('logout') }}" class="btn btn-danger">Đăng xuất</a>
</div>
@endsection
