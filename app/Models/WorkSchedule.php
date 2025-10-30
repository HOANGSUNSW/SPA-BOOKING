<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkSchedule extends Model
{
    use HasFactory;

    // Bảng tương ứng trong DB
    protected $table = 'work_schedules';

    // Các cột được phép gán giá trị hàng loạt
    protected $fillable = [
        'employee_id',
        'work_date',
        'start_time',
        'end_time',
        'shift_name',
        'note',
    ];

    // Ép kiểu dữ liệu cho các cột ngày/giờ
    protected $casts = [
        'work_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    // 🔗 Quan hệ: Một lịch làm việc thuộc về một nhân viên
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // (Tuỳ chọn) Getter để hiển thị thời gian định dạng đẹp
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->work_date)->format('d/m/Y');
    }

    public function getFormattedShiftAttribute()
    {
        return $this->shift_name
            ? "{$this->shift_name} ({$this->start_time} - {$this->end_time})"
            : null;
    }
}
