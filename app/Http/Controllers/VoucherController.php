<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        return response()->json(Voucher::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:vouchers,code',
            'name' => 'required|string|max:100',
            'discount' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        $voucher = Voucher::create($data);
        return response()->json(['message' => 'Voucher created', 'data' => $voucher], 201);
    }

    public function show($id)
    {
        return response()->json(Voucher::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());
        return response()->json(['message' => 'Voucher updated']);
    }

    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();
        return response()->json(['message' => 'Voucher deleted']);
    }
}
