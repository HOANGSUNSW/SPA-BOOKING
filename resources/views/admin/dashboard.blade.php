@extends('layouts.app')

@section('title', 'Trang quản trị')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Bảng điều khiển Quản trị</h4>
            </div>
            <div class="card-body">
                <p>Chào mừng bạn đến trang quản trị. Đây là khu vực quản lý hệ thống.</p>

                <div class="row mt-4">
                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-people fs-2 mb-2 text-primary"></i>
                                <h6>Quản lý nhân viên</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-person-check fs-2 mb-2 text-success"></i>
                                <h6>Quản lý khách hàng</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-calendar-check fs-2 mb-2 text-warning"></i>
                                <h6>Quản lý đặt lịch</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-gear fs-2 mb-2 text-danger"></i>
                                <h6>Cấu hình hệ thống</h6>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Khu vực nội dung động sẽ thêm sau --}}
            </div>
        </div>
    </div>
@endsection
