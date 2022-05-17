<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Tax;
use App\Models\Unit;

class InventoryController extends Controller
{
    public function index()
    {
        $invetories = Inventory::orderBy('name')->paginate(10);
        return view('inventory.index', ['inventories' => $invetories]);
    }

    public function create()
    {
        $categories = Category::all();
        $taxes = Tax::all();
        $units = Unit::all();
        return view('inventory.create', ['categories' => $categories, 'taxes' => $taxes, 'units' => $units]);
    }

    public function store(InventoryStoreRequest $request)
    {
        $validated = $request->validated();
        $inventory = new Inventory();
        $inventory->name = $validated['name'];
        $inventory->description = $validated['description'];
        $inventory->hsn = $validated['hsn'];
        $inventory->rate = $validated['rate'];
        $inventory->unit_id = $validated['unit'];
        $inventory->category_id = $validated['category'];
        $inventory->tax_id = $validated['tax'];
        $inventory->save();
        return redirect()->route('inventory.index')->with('status', 'Inventory Added Successfully!');
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        $categories = Category::all();
        $taxes = Tax::all();
        $units = Unit::all();
        return view('inventory.show', ['inventory' => $inventory, 'categories' => $categories, 'taxes' => $taxes, 'units' => $units]);
    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);
        $categories = Category::all();
        $taxes = Tax::all();
        $units = Unit::all();
        return view('inventory.edit', ['inventory' => $inventory, 'categories' => $categories, 'taxes' => $taxes, 'units' => $units]);
    }

    public function update(InventoryUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $inventory = Inventory::find($id);
        $inventory->name = $validated['name'];
        $inventory->description = $validated['description'];
        $inventory->hsn = $validated['hsn'];
        $inventory->rate = $validated['rate'];
        $inventory->unit_id = $validated['unit'];
        $inventory->category_id = $validated['category'];
        $inventory->tax_id = $validated['tax'];
        $inventory->save();
        return redirect()->route('inventory.index')->with('status', 'Inventory Updated Successfully!');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect()->route('inventory.index')->with('status', 'Inventory Deleted Successfully!');
    }
}
