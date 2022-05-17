<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class InvoiceItemsLivewire extends Component
{

    public $inventories;
    public $units;
    public array $data = [];
    public int $count = 1;

    protected $listeners = [
        'createInvoiceItem',
        'resetInvoiceItem'
    ];

    public function mount()
    {
        $this->inventories = Inventory::orderBy('name')->get();
        $this->units       = Unit::all();
    }

    public function render()
    {
        return view('livewire.invoice-items');
    }

    public function addItem(): void
    {
        $this->count++;
    }

    public function removeItem($id): void
    {
        $this->count--;
        unset($this->data[$id]);
    }

    public function updatedData($val, $key)
    {
        $key = explode('.', $key);
        if ($key[1] === 'inventory_id') {
            $inventory = $this->inventories->firstWhere('id', $val);
            $this->data[$key[0]]['unit_id'] = $inventory->unit_id;
            $this->data[$key[0]]['qty']  = 1;
            $this->data[$key[0]]['rate'] = $inventory->rate;
            $this->data[$key[0]]['disc'] = 0;
            $this->data[$key[0]]['hsn']  = $inventory->hsn;
        }
    }

    public function createInvoiceItem($invoice)
    {
        /*$validatedData = Validator::validate($this->data, [
            '*.invoice_id'   => 'required|integer|unique:invoices_items,invoice_id,NULL,id,inventory_id,'
                              .($this->data['inventory_id'] ?? ''),
            '*.inventory_id' => 'required|integer',
            '*.qty'          => 'nullable',
            '*.rate'         => 'nullable',
            '*.disc'         => 'nullable',
            '*.hsn'          => 'nullable',
            '*.unit_id'      => 'required|integer',
        ]);*/
        DB::beginTransaction();
        try {
            $invoice = Invoice::create($invoice);
            $invoice->invoiceItems()->createMany($this->data);
            DB::commit();
            $this->resetInvoiceItem();
            $this->dispatchBrowserEvent('hideModal', [
                'msg' => 'Invoice Created Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function resetInvoiceItem() {
        $this->data = [];
    }

}
