<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();

        return response()->json([
            'message' => 'success',
            'data' => $inventories
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'description' => 'sometimes|string'
        ]);

        $inventory = Inventory::create($data);

        return response()->json([
            'message' => 'success',
            'data' => $inventory
        ], 201);
    }

    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);

        return response()->json([
            'message' => 'success',
            'data' => $inventory
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $data = $this->validate($request, [
            'name' => 'sometimes|string',
            'quantity' => 'sometimes|numeric|min:1',
            'price' => 'sometimes|numeric|min:1',
            'description' => 'sometimes|string'
        ]);

        $inventory->update($data);

        return response()->json([
            'message' => 'success',
            'data' => $inventory
        ], 200);
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        $inventory->delete();

        return response()->json([
            'message' => 'success',
            'data' => $inventory
        ]);
    }
}
