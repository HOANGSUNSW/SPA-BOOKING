<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
    return response()->json(\App\Models\Appointment::with(['user', 'staff', 'service'])->get());
}

public function store(Request $request) {
    $data = $request->validate([
        'user_id' => 'required|exists:users,id',
        'staff_id' => 'nullable|exists:users,id',
        'service_id' => 'required|exists:services,id',
        'appointment_time' => 'required|date',
    ]);
    $appointment = \App\Models\Appointment::create($data);
    return response()->json($appointment, 201);
}

public function update(Request $request, $id) {
    $appointment = \App\Models\Appointment::findOrFail($id);
    $appointment->update($request->all());
    return response()->json($appointment);
}

public function destroy($id) {
    \App\Models\Appointment::destroy($id);
    return response()->json(['message' => 'Appointment deleted']);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}

