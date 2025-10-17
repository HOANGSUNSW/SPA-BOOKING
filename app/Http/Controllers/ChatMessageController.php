<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index()
    {
        return response()->json(ChatMessage::with('user')->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'message' => 'required|string',
            'sender' => 'in:user,bot'
        ]);
        $message = ChatMessage::create($data);
        return response()->json(['message' => 'Message saved', 'data' => $message], 201);
    }

    public function show($id)
    {
        return response()->json(ChatMessage::findOrFail($id));
    }

    public function destroy($id)
    {
        ChatMessage::findOrFail($id)->delete();
        return response()->json(['message' => 'Message deleted']);
    }
}
