<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        return response()->json(Treatment::with(['user', 'service'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:ongoing,completed,expired',
            'expiry_date' => 'nullable|date'
        ]);
        $treatment = Treatment::create($data);
        return response()->json(['message' => 'Treatment created', 'data' => $treatment], 201);
    }

    public function show($id)
    {
        return response()->json(Treatment::with('histories')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->update($request->all());
        return response()->json(['message' => 'Treatment updated']);
    }

    public function destroy($id)
    {
        Treatment::findOrFail($id)->delete();
        return response()->json(['message' => 'Treatment deleted']);
    }
}
