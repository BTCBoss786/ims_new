<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Illuminate\Support\Str;
use Livewire\Component;

class InventoryForm extends Component
{
    public $inventories;
    public $products;

    public function mount() {
        $this->inventories = Inventory::orderBy('name')->get();
        if (old('inventory')) {
            $this->products = old('inventory');
        } else {
            $this->products[] = [
                'id' => '',
                'qty' => 0,
                'rate' => 0,
                'disc' => 0
            ];
        }
    }

    public function addProduct() {
        $this->products[] = [
            'id' => '',
            'qty' => 0,
            'rate' => 0,
            'disc' => 0
        ];
    }

    public function removeProduct($index) {
        unset($this->products[$index]);
        if(empty($this->products)) {
            $this->addProduct();
        }
        array_values($this->products);
    }

    public function updatedProducts($value, $key) {
        if(Str::contains($key, 'id')) {
            $id = Str::substr($key, 0, -3);
            $this->products[$id]['rate'] = $this->inventories->find($value)->rate;
        }
    }

    public function render()
    {
        return view('livewire.inventory-form');
    }
}
