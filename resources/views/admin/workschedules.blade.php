@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
  <h4 class="fw-bold mb-0 text-dark">Lịch làm việc</h4>

  <div class="d-flex align-items-center gap-2 flex-wrap">

    <!-- 🔍 Dropdown tìm nhân viên -->
    <div class="dropdown">
      <button class="btn btn-light border d-flex align-items-center px-3 py-2" type="button"
              id="employeeFilter" data-bs-toggle="dropdown" aria-expanded="false"
              style="border-radius: 8px;">
        <i class="fa fa-search me-2 text-muted"></i>
        <span id="employeeFilterText" class="text-muted">Tìm kiếm nhân viên</span>
        <i class="fa fa-chevron-down ms-2 text-muted small"></i>
      </button>
      <ul class="dropdown-menu shadow-sm border-0 mt-2" id="employeeDropdown" style="max-height: 280px; overflow-y: auto;">
        <li><a class="dropdown-item fw-semibold text-primary" href="#" data-id="all">👥 Tất cả nhân viên</a></li>
        <li><hr class="dropdown-divider"></li>
        @foreach($employees as $emp)
          <li>
            <a class="dropdown-item" href="#" data-id="{{ $emp->id }}">
              <strong>{{ $emp->full_name }}</strong><br>
              <small class="text-muted">{{ $emp->employee_code }}</small>
            </a>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- 📆 Bộ điều hướng tuần -->
<div class="d-flex align-items-center border rounded-3 px-2 py-1 bg-white shadow-sm">
  <button id="prevWeek" type="button" class="btn btn-link text-muted p-0 px-2">
    <i class="fa fa-chevron-left"></i>
  </button>

  <!-- ✅ Nhãn hiển thị tuần -->
<span id="weekLabel"
      class="fw-semibold text-secondary px-3"
      style="cursor: pointer; user-select: none;">
    Tuần {{ ceil($weekStart->weekOfMonth) }} - Th. {{ $weekStart->month }} {{ $weekStart->year }}
</span>

<input type="date" id="weekDatePicker"
       value="{{ $weekStart->toDateString() }}"
       class="form-control position-absolute d-none"
       style="width: 200px; top: 40px; left: 0; z-index: 999;">


  <button id="nextWeek" type="button" class="btn btn-link text-muted p-0 px-2">
    <i class="fa fa-chevron-right"></i>
  </button>
</div>
    

    <!-- 🔁 Nút "Tuần này" -->
    <a href="{{ route('admin.workschedules') }}"
       class="btn btn-outline-secondary rounded-3 fw-semibold px-3 py-2">
      <i class="fa fa-rotate-left me-1"></i> Tuần này
    </a>
  </div>
</div>



    <!-- Bảng lịch -->
    <div class="table-responsive shadow-sm rounded mt-3">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Nhân viên</th>
                    @for($i = 0; $i < 7; $i++)
                        <th>{{ $weekStart->copy()->addDays($i)->isoFormat('ddd D') }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody id="scheduleTableBody">
                @foreach($employees as $emp)
                <tr data-employee-id="{{ $emp->id }}">
                    <td class="text-start align-middle">
                        <strong>{{ $emp->full_name }}</strong><br>
                        <small class="text-muted">{{ $emp->employee_code }}</small>
                    </td>

                    @for($i = 0; $i < 7; $i++)
                        @php
                            $date = $weekStart->copy()->addDays($i)->toDateString();
                            $works = isset($schedules[$emp->id])
                                ? $schedules[$emp->id]->filter(fn($item) => \Carbon\Carbon::parse($item->work_date)->toDateString() === $date)
                                : collect();
                        @endphp

                        <td class="schedule-cell position-relative align-top p-2"
                            data-employee-id="{{ $emp->id }}"
                            data-employee-name="{{ $emp->full_name }}"
                            data-date="{{ $date }}">
                            
                            {{-- Hiển thị các ca --}}
                            @foreach($works as $work)
                                <div class="work-badge shadow-sm d-flex justify-content-between align-items-center px-2 py-1 mb-1 rounded bg-light border"
                                    data-id="{{ $work->id }}">
                                    <div>
                                        <strong>{{ $work->shift_name }}</strong><br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($work->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($work->end_time)->format('H:i') }}
                                        </small>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-link text-danger p-0 delete-schedule">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endforeach

                            {{-- Nút thêm lịch --}}
                            <a href="#" class="text-primary small d-none add-schedule-link">+ Thêm lịch</a>
                        </td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal thêm ca -->
<div class="modal fade" id="addScheduleModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="addScheduleForm" class="modal-content shadow" method="POST">
      @csrf
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fa fa-calendar-plus"></i> Thêm ca làm việc</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="employee_id" id="employee_id">
        <input type="hidden" name="work_date" id="work_date">

        <div class="mb-3">
          <label>Nhân viên</label>
          <input type="text" id="employee_name" class="form-control bg-light" readonly>
        </div>

        <div class="mb-3">
          <label>Ngày làm việc</label>
          <input type="text" id="display_date" class="form-control bg-light" readonly>
        </div>

        <div class="mb-3">
          <label>Tên ca làm việc</label>
          <input type="text" name="shift_name" class="form-control" placeholder="VD: Ca sáng, Ca chiều..." required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Giờ bắt đầu</label>
            <input type="time" name="start_time" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Giờ kết thúc</label>
            <input type="time" name="end_time" class="form-control" required>
          </div>
        </div>

        <div class="mb-3">
          <label>Ghi chú</label>
          <textarea name="note" class="form-control" rows="2"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-success">Lưu</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('addScheduleModal'));
    const form = document.getElementById('addScheduleForm');

    // Hover hiện nút “+ Thêm lịch”
    document.querySelectorAll('.schedule-cell').forEach(cell => {
        const link = cell.querySelector('.add-schedule-link');
        if (!link) return;
        cell.addEventListener('mouseenter', () => link.classList.remove('d-none'));
        cell.addEventListener('mouseleave', () => link.classList.add('d-none'));
    });

    // Mở modal thêm
    document.querySelectorAll('.add-schedule-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const cell = e.target.closest('.schedule-cell');
            document.getElementById('employee_id').value = cell.dataset.employeeId;
            document.getElementById('employee_name').value = cell.dataset.employeeName;
            document.getElementById('work_date').value = cell.dataset.date;
            document.getElementById('display_date').value = cell.dataset.date;
            modal.show();
        });
    });

    // Gửi form thêm ca
    form.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(form);
        const res = await fetch("{{ route('workschedules.store') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        });
        const data = await res.json();
        if (data.success) location.reload();
        else alert("❌ Không thể thêm ca làm việc!");
    });

    // Xoá ca
    document.querySelectorAll('.delete-schedule').forEach(btn => {
        btn.addEventListener('click', async e => {
            e.preventDefault();
            const div = e.target.closest('.work-badge');
            const id = div.dataset.id;
            if (!confirm("Xoá ca làm việc này?")) return;
            const res = await fetch(`/workschedules/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            const data = await res.json();
            if (data.success) div.remove();
            else alert("❌ Không thể xoá ca làm việc!");
        });
    });

    // 🔍 Bộ lọc nhân viên
    document.querySelectorAll('#employeeDropdown .dropdown-item').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            const id = e.target.closest('a').dataset.id;
            const name = e.target.closest('a').innerText.trim();
            document.getElementById('employeeFilterText').innerText = id === 'all' ? 'Tất cả nhân viên' : name;
            document.querySelectorAll('#scheduleTableBody tr').forEach(row => {
                if (id === 'all' || row.dataset.employeeId === id) row.style.display = '';
                else row.style.display = 'none';
            });
        });
    });
});
///Chon ngay
document.addEventListener("DOMContentLoaded", function () {
  const label = document.getElementById("weekLabel");
  const picker = document.getElementById("weekDatePicker");

  // Toggle hiển thị input date
  label.addEventListener("click", (e) => {
    e.stopPropagation();
    const rect = label.getBoundingClientRect();

    picker.style.left = rect.left + "px";
    picker.style.top = rect.bottom + "px";
    picker.classList.toggle("d-none");
    picker.focus();
  });

  // Khi chọn ngày → load lại tuần
  picker.addEventListener("change", e => {
    window.location = `?week_start=${e.target.value}`;
  });

  // Khi click ra ngoài → ẩn picker
  document.addEventListener("click", (e) => {
    if (!picker.contains(e.target) && e.target !== label) {
      picker.classList.add("d-none");
    }
  });

  // Điều hướng tuần
  const formatDate = d => d.toISOString().split("T")[0];
  document.getElementById("prevWeek").onclick = () => {
    const d = new Date(picker.value);
    d.setDate(d.getDate() - 7);
    window.location = `?week_start=${formatDate(d)}`;
  };
  document.getElementById("nextWeek").onclick = () => {
    const d = new Date(picker.value);
    d.setDate(d.getDate() + 7);
    window.location = `?week_start=${formatDate(d)}`;
  };
});

</script>
@endpush
