<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\State;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->paginate(10);
        return view('customer.index', ['customers' => $customers]);
    }

    public function create()
    {
        $states = State::orderBy('code')->get();
        return view('customer.create', ['states' => $states]);
    }

    public function store(CustomerStoreRequest $request)
    {
        $validated = $request->validated();
        $customer = new Customer();
        $customer->name = $validated['name'];
        $customer->gstin = $validated['gstin'];
        $customer->address1 = $validated['address1'];
        $customer->address2 = $validated['address2'];
        $customer->city = $validated['city'];
        $customer->state_id = $validated['state'];
        $customer->save();
        return redirect()->route('customer.index')->with('status', 'Customer Added Successfully!');
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        $states = State::orderBy('code')->get();
        return view('customer.show', ['customer' => $customer, 'states' => $states]);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        $states = State::orderBy('code')->get();
        return view('customer.edit', ['customer' => $customer, 'states' => $states]);
    }

    public function update(CustomerUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $customer = Customer::find($id);
        $customer->name = $validated['name'];
        $customer->gstin = $validated['gstin'];
        $customer->address1 = $validated['address1'];
        $customer->address2 = $validated['address2'];
        $customer->city = $validated['city'];
        $customer->state_id = $validated['state'];
        $customer->save();
        return redirect()->route('customer.index')->with('status', 'Customer Updated Successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('status', 'Customer Deleted Successfully!');
    }
}
