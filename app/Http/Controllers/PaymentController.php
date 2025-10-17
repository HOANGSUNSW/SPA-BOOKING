<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::with('booking')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string',
            'status' => 'in:pending,paid,failed'
        ]);
        $payment = Payment::create($data);
        return response()->json(['message' => 'Payment created', 'data' => $payment], 201);
    }

    public function show($id)
    {
        return response()->json(Payment::with('booking')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return response()->json(['message' => 'Payment updated']);
    }

    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return response()->json(['message' => 'Payment deleted']);
    }
}
