<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index()
    {
        return response()->json(ServiceType::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100', 'description' => 'nullable|string']);
        $type = ServiceType::create($data);
        return response()->json(['message' => 'Service type created', 'data' => $type], 201);
    }

    public function show($id)
    {
        return response()->json(ServiceType::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $type = ServiceType::findOrFail($id);
        $type->update($request->only('name', 'description'));
        return response()->json(['message' => 'Service type updated']);
    }

    public function destroy($id)
    {
        ServiceType::findOrFail($id)->delete();
        return response()->json(['message' => 'Service type deleted']);
    }
}
