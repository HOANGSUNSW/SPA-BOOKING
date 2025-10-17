@extends('layouts.app')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="row">
        <!-- Thông tin tài khoản -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user me-2"></i> Thông tin tài khoản
                </div>
                <div class="card-body">
                    <p>
                        <stzrong>Tên:</strong> {{ Auth::user()->name }}
                    </p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Vai trò:</strong> {{ Auth::user()->role ?? 'Người dùng' }}</p>
                </div>
            </div>
        </div>

        <!-- Các chức năng nhanh -->
        <div class="col-md-8 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-bolt me-2"></i> Thao tác nhanh
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-success"><i class="fas fa-calendar-check me-2"></i> Đặt lịch
                            mới</a>
                        <a href="#" class="btn btn-outline-primary"><i class="fas fa-history me-2"></i> Lịch sử đặt
                            lịch</a>
                        <a href="#" class="btn btn-outline-secondary"><i class="fas fa-star me-2"></i> Đánh giá dịch
                            vụ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
