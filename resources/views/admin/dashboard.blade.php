@extends('layouts.admin')
@section('title', 'Admin Dashboard - Anh Thơ Spa')

@section('content')
{{-- Thanh menu ngang --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        {{-- Logo --}}
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <img src="{{ asset('imgs/logo.jpg') }}" alt="Logo" height="28" class="me-2">
            Anh Thơ Spa
        </a>

        {{-- Nút toggle khi thu nhỏ --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="#" class="nav-link active">Tổng quan</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nhanvienDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Khách Hàng
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nhanvienDropdown">
                        <li><a class="dropdown-item" href="#">Ưu đãi</a></li>
                        <li><a class="dropdown-item" href="#">Khuyến mãi</a></li>
                        <li><a class="dropdown-item" href="#">Khách hàng</a></li>
                    </ul>
                </li>

                {{-- Dropdown Nhân viên --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nhanvienDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nhân viên
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nhanvienDropdown">
                        <li><a class="dropdown-item" href="#">Quản lý nhân viên</a></li>
                        <li><a class="dropdown-item" href="#">Lịch làm việc</a></li>
                        <li><a class="dropdown-item" href="#">Bảng chấm công</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Đặt lịch</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Báo cáo</a>
                </li>
            </ul>

            {{-- Icon góc phải --}}
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-light btn-sm me-2">
                    <i class="bi bi-bell"></i>
                </button>
                <button class="btn btn-outline-light btn-sm">
                    <i class="bi bi-gear"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- Nội dung trang --}}
<div class="container-fluid py-4">
    <div class="text-center text-muted">
        <h5 class="fw-bold text-primary">Chào mừng đến trang quản trị Anh Thơ Spa</h5>
        <p>Chọn mục ở thanh điều hướng để xem chi tiết (Tổng quan, Khách hàng, Nhân viên, Đặt lịch, Báo cáo...)</p>
    </div>
</div>
@endsection
