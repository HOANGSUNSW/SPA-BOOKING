<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\WorkSchedule;   
use Illuminate\Http\Request;
use Carbon\Carbon;

class WorkScheduleController extends Controller
{
public function index(Request $request)
{
    $employees = Employee::all();
    $weekStart = $request->input('week_start')
        ? \Carbon\Carbon::parse($request->input('week_start'))->startOfWeek()
        : \Carbon\Carbon::now()->startOfWeek();

    $schedules = WorkSchedule::with('employee')
        ->get()
        ->groupBy('employee_id');

    return view('admin.workschedules', compact('employees', 'schedules', 'weekStart'));
}

public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'work_date'   => 'required|date',
        'shift_name'  => 'required|string',
        'start_time'  => 'required',
        'end_time'    => 'required',
    ]);

    $schedule = WorkSchedule::create([
        'employee_id' => $request->employee_id,
        'work_date'   => $request->work_date,
        'shift_name'  => $request->shift_name,
        'start_time'  => $request->start_time,
        'end_time'    => $request->end_time,
        'note'        => $request->note,
    ]);

    return response()->json(['success' => true, 'schedule' => $schedule]);
}

public function destroy($id)
{
    $schedule = WorkSchedule::find($id);
    if (!$schedule) return response()->json(['success' => false]);
    $schedule->delete();
    return response()->json(['success' => true]);
}

}
