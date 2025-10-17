<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service', 'staff'])->latest()->get();
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'nullable|exists:users,id',
            'appointment_time' => 'required|date',
            'status' => 'in:pending,confirmed,cancelled,completed',
            'note' => 'nullable|string',
        ]);

        $booking = Booking::create($data);
        return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 201);
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'service'])->findOrFail($id);
        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return response()->json(['message' => 'Booking updated successfully']);
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return response()->json(['message' => 'Booking deleted']);
    }
}
