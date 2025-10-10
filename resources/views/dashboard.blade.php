@extends('layouts.app')

@section('title', 'Bảng điều khiển - Anh Thơ Spa')

@section('content')
<div class="container">
    <div class="row">
        <!-- Thông tin người dùng -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header"><h5>Thông tin tài khoản</h5></div>
                <div class="card-body">
                    <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Điện thoại:</strong> {{ Auth::user()->phone ?? 'Chưa cập nhật' }}</p>
                    <p><strong>Địa chỉ:</strong> {{ Auth::user()->address ?? 'Chưa cập nhật' }}</p>
                    <p><strong>Vai trò:</strong> <span class="badge bg-primary">{{ Auth::user()->role }}</span></p>
                </div>
            </div>
        </div>

        <!-- Thao tác nhanh -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header"><h5>Thao tác nhanh</h5></div>
                <div class="card-body">
                    <a href="{{ route('booking.index') }}" class="btn btn-success mb-2 w-100">
                        <i class="fas fa-calendar-check me-2"></i> Đặt lịch mới
                    </a>
                    <a href="{{ route('user.bookings') }}" class="btn btn-outline-primary mb-2 w-100">
                        <i class="fas fa-history me-2"></i> Lịch sử đặt lịch
                    </a>
                    <a href="{{ route('user.reviews') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-star me-2"></i> Đánh giá dịch vụ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
