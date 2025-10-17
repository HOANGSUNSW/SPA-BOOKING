@extends('layouts.admin') {{-- dùng layout admin riêng nếu bạn đã tách --}}

@section('title', 'Quản lý khách hàng - Anh Thơ Spa')

@section('content')
<div class="container-fluid py-3">

    {{-- Tiêu đề và thanh công cụ --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary mb-2 mb-md-0">Khách hàng</h4>

        <div class="d-flex gap-2">
            <input type="text" class="form-control" placeholder="Tìm theo mã, tên, số điện thoại" style="min-width: 250px;">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-sliders"></i>
            </button>
            <button class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Khách hàng
            </button>
            <div class="btn-group">
                <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-file-earmark-arrow-up"></i> Nhập file
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Từ Excel (.xlsx)</a></li>
                    <li><a class="dropdown-item" href="#">Từ CSV (.csv)</a></li>
                </ul>
            </div>
            <button class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-arrow-down"></i> Xuất file
            </button>
        </div>
    </div>

    {{-- Bảng danh sách khách hàng --}}
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col"><input type="checkbox"></th>
                        <th scope="col">Mã khách hàng</th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Tỉnh/Thành phố</th>
                        <th scope="col">Xã/Phường</th>
                        <th scope="col">Địa chỉ cũ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>KH000005</td>
                        <td>Anh Giang - Kim Mã</td>
                        <td>0905123456</td>
                        <td>123 Kim Mã</td>
                        <td>Hà Nội</td>
                        <td>Ba Đình</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>KH000004</td>
                        <td>Anh Hoàng - Sài Gòn</td>
                        <td>0912345678</td>
                        <td>45 Nguyễn Trãi</td>
                        <td>TP.HCM</td>
                        <td>Quận 5</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>KH000003</td>
                        <td>Tuấn - Hà Nội</td>
                        <td>0988123123</td>
                        <td>78 Hai Bà Trưng</td>
                        <td>Hà Nội</td>
                        <td>Hoàn Kiếm</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>KH000002</td>
                        <td>Phạm Thu Hương</td>
                        <td>0978222333</td>
                        <td>56 Nguyễn Huệ</td>
                        <td>Cần Thơ</td>
                        <td>Ninh Kiều</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>KH000001</td>
                        <td>Nguyễn Văn Hải</td>
                        <td>0909777888</td>
                        <td>12 Trần Phú</td>
                        <td>Hải Phòng</td>
                        <td>Lê Chân</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Phân trang và hiển thị số lượng --}}
        <div class="d-flex justify-content-between align-items-center p-3">
            <div>
                Hiển thị:
                <select class="form-select form-select-sm d-inline-block w-auto">
                    <option>10 bản ghi</option>
                    <option>20 bản ghi</option>
                    <option>50 bản ghi</option>
                </select>
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
