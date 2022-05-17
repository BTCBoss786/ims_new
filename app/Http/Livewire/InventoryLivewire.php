<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Tax;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryLivewire extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public array $data = [];
    public Inventory $inventory;
    public bool $isEdit = false;

    public function render()
    {
        $inventories = Inventory::orderBy('name')->paginate(10);
        $categories  = Category::all();
        $taxes       = Tax::all();
        $units       = Unit::all();

        return view('livewire.inventory', [
            'inventories' => $inventories,
            'categories'  => $categories,
            'taxes'       => $taxes,
            'units'       => $units,
        ]);
    }

    public function newInventory(): void
    {
        $this->isEdit = false;
        $this->data   = [];
        $this->dispatchBrowserEvent('showModal');
    }

    public function createInventory(): void
    {
        $validatedData = Validator::validate($this->data, [
            'name'        => 'required|unique:inventories,name,NULL,id,description,'
                             .($this->data['description'] ?? ''),
            'description' => 'nullable',
            'hsn'         => 'required',
            'rate'        => 'required|numeric',
            'unit_id'     => 'required|integer',
            'category_id' => 'required|integer',
            'tax_id'      => 'required|integer',
        ]);
        Inventory::create($validatedData);
        $this->dispatchBrowserEvent('hideModal', [
            'msg' => 'Inventory Created Successfully',
        ]);
    }

    public function editInventory(Inventory $inventory): void
    {
        $this->isEdit    = true;
        $this->data      = $inventory->toArray();
        $this->inventory = $inventory;
        $this->dispatchBrowserEvent('showModal');
    }

    public function updateInventory(): void
    {
        $validatedData = Validator::validate($this->data, [
            'name'        => 'required|unique:inventories,name,'
                             .$this->inventory->id.',id,description,'
                             .($this->data['description'] ?? ''),
            'description' => 'nullable',
            'hsn'         => 'required',
            'rate'        => 'required|numeric',
            'unit_id'     => 'required|integer',
            'category_id' => 'required|integer',
            'tax_id'      => 'required|integer',
        ]);
        $this->inventory->update($validatedData);
        $this->dispatchBrowserEvent('hideModal', [
            'msg' => 'Inventory Updated Successfully',
        ]);
    }

}
