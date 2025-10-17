<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(Review::with(['user', 'service'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);
        $review = Review::create($data);
        return response()->json(['message' => 'Review added', 'data' => $review], 201);
    }

    public function show($id)
    {
        return response()->json(Review::with(['user', 'service'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->update($request->all());
        return response()->json(['message' => 'Review updated']);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json(['message' => 'Review deleted']);
    }
}
