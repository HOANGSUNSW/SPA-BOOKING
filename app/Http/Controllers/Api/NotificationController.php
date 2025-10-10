<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index($userId)
{
    return response()->json(
        \App\Models\Notification::where('user_id', $userId)->orderBy('created_at', 'desc')->get()
    );
}

public function markAsRead($id)
{
    $notification = \App\Models\Notification::findOrFail($id);
    $notification->update(['is_read' => true]);
    return response()->json(['message' => 'Notification marked as read']);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
