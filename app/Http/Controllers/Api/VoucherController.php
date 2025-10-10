<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index() {
    return response()->json(\App\Models\Voucher::all());
}

public function store(Request $request) {
    $data = $request->validate([
        'code' => 'required|unique:vouchers',
        'name' => 'required',
        'discount_value' => 'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);
    $voucher = \App\Models\Voucher::create($data);
    return response()->json($voucher, 201);
}

public function update(Request $request, $id) {
    $voucher = \App\Models\Voucher::findOrFail($id);
    $voucher->update($request->all());
    return response()->json($voucher);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
