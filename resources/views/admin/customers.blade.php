@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary"><i class="fa fa-user-friends"></i> Quản lý khách hàng</h3>
        <button class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="fa fa-plus"></i> Thêm khách hàng
        </button>
    </div>

    <!-- Tìm kiếm -->
    <form method="GET" action="{{ route('admin.customers') }}" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                   placeholder="🔍 Tìm theo mã, tên hoặc số điện thoại...">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
        </div>
        <div class="col-md-2 d-grid">
            <a href="{{ route('admin.customers') }}" class="btn btn-secondary"><i class="fa fa-rotate-left"></i> Làm mới</a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger text-center shadow-sm">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-warning">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Bảng danh sách -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>
    <a href="{{ route('admin.customers', [
        'sort_by' => 'customer_code',
        'sort_order' => ($sortBy == 'customer_code' && $sortOrder == 'asc') ? 'desc' : 'asc'
    ]) }}" class="text-decoration-none text-dark">
        Mã KH
        @if($sortBy == 'customer_code')
            <i class="fa fa-sort-{{ $sortOrder == 'asc' ? 'up' : 'down' }}"></i>
        @else
            <i class="fa fa-sort text-muted"></i>
        @endif
    </a>
</th>

<th>
    <a href="{{ route('admin.customers', [
        'sort_by' => 'full_name',
        'sort_order' => ($sortBy == 'full_name' && $sortOrder == 'asc') ? 'desc' : 'asc'
    ]) }}" class="text-decoration-none text-dark">
        Họ và Tên
        @if($sortBy == 'full_name')
            <i class="fa fa-sort-{{ $sortOrder == 'asc' ? 'up' : 'down' }}"></i>
        @else
            <i class="fa fa-sort text-muted"></i>
        @endif
    </a>
</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ngày sinh</th>
                    <th>Điểm tích lũy</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $c)
                <tr>
                    <td>{{ $c->customer_code }}</td>
                    <td>{{ $c->full_name }}</td>
                    <td>{{ $c->gender ?? '-' }}</td>
                    <td>{{ $c->email ?? '-' }}</td>
                    <td>{{ $c->phone_number }}</td>
                    <td>{{ $c->dob ? \Carbon\Carbon::parse($c->dob)->format('d/m/Y') : '-' }}</td>
                    <td><span class="badge bg-info text-dark">{{ $c->loyalty_points }} điểm</span></td>
                    <td>
                        <span class="badge bg-{{ $c->status == 'Active' ? 'success' : 'secondary' }}">
                            {{ $c->status == 'Active' ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                        </span>
                    </td>
                    <td>{{ $c->note ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#editCustomerModal_{{ $c->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <form action="{{ route('customers.destroy', $c->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa khách hàng này không?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center text-muted">Không có khách hàng nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================== -->
<!-- MODALS (Đặt ngoài bảng) -->
<!-- ========================== -->
@foreach($customers as $c)
<div class="modal fade" id="editCustomerModal_{{ $c->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content shadow" action="{{ route('customers.update', $c->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fa fa-user-edit"></i> Chỉnh sửa thông tin khách hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-4">
                    <label>Mã khách hàng</label>
                    <input type="text" name="customer_code" value="{{ $c->customer_code }}" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Họ và Tên</label>
                    <input type="text" name="full_name" value="{{ $c->full_name }}" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Giới tính</label>
                    <select name="gender" class="form-select">
                        <option value="">-- Chọn --</option>
                        <option value="Nam" {{ $c->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $c->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ $c->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Ngày sinh</label>
                    <input type="date" name="dob" value="{{ $c->dob }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $c->email }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone_number" value="{{ $c->phone_number }}" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{ $c->address }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="Active" {{ $c->status == 'Active' ? 'selected' : '' }}>Đang hoạt động</option>
                        <option value="Inactive" {{ $c->status == 'Inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Điểm tích lũy</label>
                    <input type="number" name="loyalty_points" value="{{ $c->loyalty_points }}" class="form-control" min="0">
                </div>
                <div class="col-12">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="2">{{ $c->note }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Modal Thêm khách hàng -->
<div class="modal fade" id="addCustomerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content shadow" action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fa fa-user-plus"></i> Thêm khách hàng mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-4">
                    <label>Mã khách hàng</label>
                    <input type="text" name="customer_code" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-8">
                    <label>Họ và Tên</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Giới tính</label>
                    <select name="gender" class="form-select">
                        <option value="">-- Chọn --</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Ngày sinh</label>
                    <input type="date" name="dob" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone_number" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="Active">Đang hoạt động</option>
                        <option value="Inactive">Ngưng hoạt động</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Điểm tích lũy</label>
                    <input type="number" name="loyalty_points" class="form-control" value="0" min="0">
                </div>
                <div class="col-12">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-success">Thêm mới</button>
            </div>
        </form>
    </div>
</div>
@endsection
