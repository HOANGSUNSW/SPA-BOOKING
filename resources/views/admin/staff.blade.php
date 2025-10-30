@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary"><i class="fa fa-users"></i> Quản lý nhân viên</h3>
        <button class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            <i class="fa fa-plus"></i> Thêm nhân viên
        </button>
    </div>

    <!-- Bộ lọc & Tìm kiếm -->
    <form method="GET" action="{{ route('admin.staff') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                   placeholder="🔍 Tìm theo mã hoặc tên nhân viên...">
        </div>
        <div class="col-md-3">
            <select name="role" class="form-select">
                <option value="">-- Lọc theo chức vụ --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Nhân viên</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
        </div>
        <div class="col-md-2 d-grid">
            <a href="{{ route('admin.staff') }}" class="btn btn-secondary"><i class="fa fa-rotate-left"></i> Làm mới</a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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
                        <a href="{{ route('admin.staff', [
                            'sort_by' => 'employee_code',
                            'sort_order' => ($sortBy == 'employee_code' && $sortOrder == 'asc') ? 'desc' : 'asc'
                        ]) }}" class="text-decoration-none text-dark">
                            Mã NV
                            @if($sortBy == 'employee_code')
                                <i class="fa fa-sort-{{ $sortOrder == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fa fa-sort text-muted"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.staff', [
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
                    <th>Chức vụ</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr>
                    <td>{{ $emp->employee_code }}</td>
                    <td>{{ $emp->full_name }}</td>
                    <td><span class="badge bg-info text-dark">{{ $emp->role }}</span></td>
                    <td>{{ $emp->email ?? '-' }}</td>
                    <td>{{ $emp->phone_number ?? '-' }}</td>
                    <td>{{ $emp->address ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $emp->status == 'Active' ? 'success' : 'secondary' }}">
                            {{ $emp->status == 'Active' ? 'Đang làm' : 'Ngưng làm' }}
                        </span>
                    </td>
                    <td>{{ $emp->note ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#editEmployeeModal_{{ $emp->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa nhân viên này không?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted">Không có nhân viên nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL SỬA NHÂN VIÊN -->
@foreach($employees as $emp)
<div class="modal fade" id="editEmployeeModal_{{ $emp->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content shadow" action="{{ route('employees.update', $emp->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fa fa-pen"></i> Chỉnh sửa nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                 @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>  
    @endif
                 <div class="mb-3">
                    <label>Mã nhân viên</label>
                    <input type="text" name="employee_code" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Họ và Tên</label>
                    <input type="text" name="full_name" value="{{ $emp->full_name }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>C    hức vụ</label>
                    <select name="role" class="form-select">
                        <option value="admin" {{ $emp->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                        <option value="staff" {{ $emp->role == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                        <option value="user" {{ $emp->role == 'user' ? 'selected' : '' }}>Khách hàng</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $emp->email }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone_number" value="{{ $emp->phone_number }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{ $emp->address }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="Active" {{ $emp->status == 'Active' ? 'selected' : '' }}>Đang làm</option>
                        <option value="Inactive" {{ $emp->status == 'Inactive' ? 'selected' : '' }}>Ngưng làm</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control">{{ $emp->note }}</textarea>
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

<!-- MODAL THÊM NHÂN VIÊN -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content shadow" action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fa fa-user-plus"></i> Thêm nhân viên mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                 @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                <div class="mb-3">
                    <label>Mã nhân viên</label>
                    <input type="text" name="employee_code" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Họ và Tên</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Chức vụ</label>
                    <select name="role" class="form-select">
                        <option value="admin">Quản trị viên</option>
                        <option value="staff" selected>Nhân viên</option>
                        <option value="user">Khách hàng</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone_number" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="Active">Đang làm</option>
                        <option value="Inactive">Ngưng làm</option>
                    </select>
                </div>
                <div class="mb-3">
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
