<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerLivewire extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public array $data = [];
    public Customer $customer;
    public bool $isEdit = false;

    public function render()
    {
        $customers = Customer::orderBy('name')->paginate(10);
        $states    = State::orderBy('code')->get();

        return view('livewire.customer', [
            'customers' => $customers,
            'states'    => $states,
        ]);
    }

    public function newCustomer(): void
    {
        $this->isEdit = false;
        $this->data   = [];
        $this->dispatchBrowserEvent('showModal');
    }

    public function createCustomer(): void
    {
        $validatedData = Validator::validate($this->data, [
            'name'     => 'required',
            'gstin'    => 'nullable',
            'address1' => 'required',
            'address2' => 'nullable',
            'city'     => 'required',
            'state_id' => 'required|integer',
        ]);
        Customer::create($validatedData);
        $this->dispatchBrowserEvent('hideModal', [
            'msg' => 'Customer Created Successfully',
        ]);
    }

    public function editCustomer(Customer $customer): void
    {
        $this->isEdit   = true;
        $this->data     = $customer->toArray();
        $this->customer = $customer;
        $this->dispatchBrowserEvent('showModal');
    }

    public function updateCustomer(): void
    {
        $validatedData = Validator::validate($this->data, [
            'name'     => 'required',
            'gstin'    => 'nullable|unique:customers,gstin,'
                          .$this->customer->id,
            'address1' => 'required',
            'address2' => 'nullable',
            'city'     => 'required',
            'state_id' => 'required',
        ]);
        $this->customer->update($validatedData);
        $this->dispatchBrowserEvent('hideModal', [
            'msg' => 'Customer Updated Successfully',
        ]);
    }

}
