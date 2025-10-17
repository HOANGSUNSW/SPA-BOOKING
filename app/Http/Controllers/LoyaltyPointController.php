<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;

class LoyaltyPointController extends Controller
{
    public function index()
    {
        return response()->json(LoyaltyPoint::with('user')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'integer|min:0',
            'level' => 'in:bronze,silver,gold,platinum',
        ]);

        $loyalty = LoyaltyPoint::create($data);
        return response()->json(['message' => 'Loyalty point record created', 'data' => $loyalty], 201);
    }

    public function show($id)
    {
        return response()->json(LoyaltyPoint::with('user')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $loyalty = LoyaltyPoint::findOrFail($id);
        $loyalty->update($request->only('points', 'level'));
        return response()->json(['message' => 'Loyalty point updated']);
    }

    public function destroy($id)
    {
        LoyaltyPoint::findOrFail($id)->delete();
        return response()->json(['message' => 'Record deleted']);
    }
}
