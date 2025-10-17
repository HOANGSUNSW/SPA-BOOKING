<?php

namespace App\Http\Controllers;

use App\Models\StaffSchedule;
use Illuminate\Http\Request;

class StaffScheduleController extends Controller
{
    public function index()
    {
        return response()->json(StaffSchedule::with('staff')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'work_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);
        $schedule = StaffSchedule::create($data);
        return response()->json(['message' => 'Schedule created', 'data' => $schedule], 201);
    }

    public function show($id)
    {
        return response()->json(StaffSchedule::with('staff')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $schedule = StaffSchedule::findOrFail($id);
        $schedule->update($request->all());
        return response()->json(['message' => 'Schedule updated']);
    }

    public function destroy($id)
    {
        StaffSchedule::findOrFail($id)->delete();
        return response()->json(['message' => 'Schedule deleted']);
    }
}
