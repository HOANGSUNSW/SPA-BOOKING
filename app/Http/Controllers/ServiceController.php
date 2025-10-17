<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(Service::with('type')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1'
        ]);
        $service = Service::create($data);
        return response()->json(['message' => 'Service created', 'data' => $service], 201);
    }

    public function show($id)
    {
        return response()->json(Service::with('type')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return response()->json(['message' => 'Service updated']);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->json(['message' => 'Service deleted']);
    }
}
