<?php

namespace App\Http\Controllers;

use App\Models\TreatmentHistory;
use Illuminate\Http\Request;

class TreatmentHistoryController extends Controller
{
    public function index()
    {
        return response()->json(TreatmentHistory::with('treatment')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'treatment_id' => 'required|exists:treatments,id',
            'session_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);
        $history = TreatmentHistory::create($data);
        return response()->json(['message' => 'Treatment session added', 'data' => $history], 201);
    }

    public function show($id)
    {
        return response()->json(TreatmentHistory::with('treatment')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $history = TreatmentHistory::findOrFail($id);
        $history->update($request->all());
        return response()->json(['message' => 'Session updated']);
    }

    public function destroy($id)
    {
        TreatmentHistory::findOrFail($id)->delete();
        return response()->json(['message' => 'Session deleted']);
    }
}
