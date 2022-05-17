<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('invoice.index', ['invoices' => $invoices]);
    }

    public function create()
    {
        if(!Gate::allows('subscribed')) abort(403);
        $customers = Customer::orderBy('name')->get();
        return view('invoice.create', ['customers' => $customers]);
    }

    public function store(InvoiceStoreRequest $request)
    {
        if(!Gate::allows('subscribed')) abort(403);
        $validated = $request->validated();
        DB::transaction(function() use ($validated) {
            $invoice = new Invoice();
            $invoice->inv_ref = $validated['inv_ref'];
            $invoice->inv_date = $validated['inv_date'];
            $invoice->customer_id = $validated['customer'];
            $invoice->chal_no = $validated['chal_no'];
            $invoice->chal_date = $validated['chal_date'];
            $invoice->po_no = $validated['po_no'];
            $invoice->reverse_charge = $validated['reverse_charge'];
            $invoice->transporter_name = $validated['transporter_name'];
            $invoice->lr_no = $validated['lr_no'];
            $invoice->vehicle_no = $validated['vehicle_no'];
            if ($invoice->save()) {
                for ($i=0; $i<count($validated['inventory']); $i++) { 
                    $inventory = $validated['inventory'][$i];
                    $invoiceItem = new InvoiceItem();
                    $invoiceItem['inventory_id'] = $inventory['id'];
                    $invoiceItem['qty'] = $inventory['qty'];
                    $invoiceItem['rate'] = $inventory['rate'];
                    $invoiceItem['disc'] = $inventory['disc'];
                    $invoice->invoiceItems()->save($invoiceItem);
                }
            }
        });
        return redirect()->route('invoice.index')->with('status', 'Invoice Generated Successfully!');
    }

    public function show($id)
    {
        $invoiceData = Invoice::with(['customer' => function($query){
            $query->with(['state']);
        }, 'invoiceItems' => function($query){
            $query->with(['inventory' => function($query){
                $query->with(['unit', 'category', 'tax']);
            }]);
        }])->find($id);
        return view('invoice.show', ['invoiceData' => $invoiceData]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
